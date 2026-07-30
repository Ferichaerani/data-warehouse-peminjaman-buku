<?php

namespace App\Filament\Resources;

use App\Models\Pinjam;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ReportResource extends Resource
{
    protected static ?string $model = Pinjam::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Laporan Peminjaman';
    protected static ?int $navigationSort = 6;

    public static function table(Table $table): Table
    {
        return $table
            ->query(
                Pinjam::with(['mahasiswa', 'buku', 'kembali'])
            )
            ->columns([
                Tables\Columns\TextColumn::make('mahasiswa.nama')
                    ->label('Nama Siswa')
                    ->searchable(),

                Tables\Columns\TextColumn::make('buku.judul')
                    ->label('Judul Buku')
                    ->searchable(),

                Tables\Columns\TextColumn::make('tanggal_pinjam')
                    ->date()
                    ->label('Tanggal Pinjam'),

                Tables\Columns\TextColumn::make('tanggal_kembali')
                    ->date()
                    ->label('Tanggal Kembali'),

                Tables\Columns\TextColumn::make('kembali.tanggal_pengembalian')
                    ->date()
                    ->label('Tanggal Dikembalikan')
                    ->formatStateUsing(
                        fn ($state) => $state ?? 'Belum dikembalikan'
                    ),

                Tables\Columns\TextColumn::make('kembali.denda')
                    ->label('Denda')
                    ->money('IDR')
                    ->formatStateUsing(
                        fn ($state) => $state ?? 0
                    ),

                // ✅ STATUS OTOMATIS (PERBAIKAN UTAMA)
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->getStateUsing(
                        fn ($record) =>
                            $record->kembali
                                ? 'Dikembalikan'
                                : 'Dipinjam'
                    )
                    ->colors([
                        'success' => fn ($state, $record) => (bool) $record->kembali,
                        'warning' => fn ($state, $record) => ! $record->kembali,
                    ]),
            ])
            ->filters([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\ReportResource\Pages\ListReports::route('/'),
        ];
    }
}
