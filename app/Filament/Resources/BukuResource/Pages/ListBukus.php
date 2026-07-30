<?php

namespace App\Filament\Resources\BukuResource\Pages;

use App\Filament\Resources\BukuResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables;
use Filament\Forms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class ListBukus extends ListRecords
{
    protected static string $resource = BukuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('judul')->searchable(),
            TextColumn::make('penulis')->searchable(),
            TextColumn::make('penerbit')->searchable(),
            TextColumn::make('stok'),
            TextColumn::make('status')
                ->label('Status')
                ->getStateUsing(fn ($record) => $record->status)
                ->badge()
                ->color(fn ($state) => $state === 'Tersedia' ? 'success' : 'danger'),
        ];
    }

    protected function getTableFilters(): array
    {
        return [
            Filter::make('Status')
                ->form([
                    Forms\Components\Select::make('status')
                        ->label('Status Buku')
                        ->options([
                            'Dipinjam' => 'Dipinjam',
                            'Tersedia' => 'Tersedia',
                        ]),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    if (empty($data['status'])) {
                        return $query;
                    }

                    return match ($data['status']) {
                        'Dipinjam' => $query->whereHas('pinjams', fn ($q) => $q->whereNull('tanggal_kembali')),
                        'Tersedia' => $query->whereDoesntHave('pinjams', fn ($q) => $q->whereNull('tanggal_kembali')),
                        default => $query,
                    };
                }),
        ];
    }
}
