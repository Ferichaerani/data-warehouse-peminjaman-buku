<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BukuResource\Pages;
use App\Models\Buku;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;

class BukuResource extends Resource
{
    protected static ?string $model = Buku::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    
    protected static ?int $navigationSort = 2;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('judul')->required(),
                Forms\Components\TextInput::make('penulis')->required(),
                Forms\Components\TextInput::make('penerbit')->required(),

                // Tambahan kategori
                Select::make('kategori')
                    ->label('Kategori')
                    ->options([
                        'Sains' => 'Sains',
                        'Novel' => 'Novel',
                        'Komik' => 'Komik',
                        'Sejarah' => 'Sejarah',
                    ])
                    ->required(),

                Forms\Components\TextInput::make('stok')->numeric()->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('judul')->searchable(),
                Tables\Columns\TextColumn::make('penulis')->searchable(),
                Tables\Columns\TextColumn::make('penerbit')->searchable(),

                // Tampilkan kolom kategori
                Tables\Columns\TextColumn::make('kategori')->label('Kategori')->searchable(),

                Tables\Columns\TextColumn::make('stok'),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->getStateUsing(fn ($record) => $record->stok > 0 ? 'Tersedia' : 'Dipinjam')
                    ->colors([
                        'success' => fn ($state) => $state === 'Tersedia',
                        'danger' => fn ($state) => $state === 'Dipinjam',
                    ]),
            ])
            ->filters([
                // Filter kategori
                SelectFilter::make('kategori')
                    ->label('Filter Kategori')
                    ->options([
                        'Sains' => 'Sains',
                        'Novel' => 'Novel',
                        'Komik' => 'Komik',
                        'Sejarah' => 'Sejarah',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBukus::route('/'),
            'create' => Pages\CreateBuku::route('/create'),
            'edit' => Pages\EditBuku::route('/{record}/edit'),
        ];
    }
}
