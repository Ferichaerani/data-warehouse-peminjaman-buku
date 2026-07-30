<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KembaliResource\Pages;
use App\Models\Kembali;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class KembaliResource extends Resource
{
    protected static ?string $model = Kembali::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?int $navigationSort = 5;



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('pinjam_id')
                    ->relationship('pinjam', 'id')
                    ->required(),
                Forms\Components\DatePicker::make('tanggal_pengembalian')->required(),
                Forms\Components\TextInput::make('denda')->numeric()->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pinjam.mahasiswa.nama')->label('Siswa'),
                Tables\Columns\TextColumn::make('pinjam.buku.judul')->label('Judul Buku'),
                Tables\Columns\TextColumn::make('tanggal_pengembalian')->date(),
                Tables\Columns\TextColumn::make('denda')->money('IDR'),
            ])
            ->filters([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKembalis::route('/'),
            'create' => Pages\CreateKembali::route('/create'),
            'edit' => Pages\EditKembali::route('/{record}/edit'),
        ];
    }
}
