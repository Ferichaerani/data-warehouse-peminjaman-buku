<?php

namespace App\Filament\Resources;

use App\Models\Mahasiswa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Filament\Resources\MahasiswaResource\Pages;

class MahasiswaResource extends Resource
{
    protected static ?string $model = Mahasiswa::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Siswa';
    protected static ?int $navigationSort = 3;

    // Biar judul halaman juga “Siswa”
    protected static ?string $label = 'Siswa';
    protected static ?string $pluralLabel = 'Siswa';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nim')
                    ->label('NIS')        // 👈 GANTI TAMPILAN
                    ->required()
                    ->unique(ignoreRecord: true),

                Forms\Components\TextInput::make('nama')
                    ->label('Nama Siswa')
                    ->required(),

                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true),

                Forms\Components\TextInput::make('no_telp')
                    ->label('No. Telp')
                    ->tel()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nim')
                    ->label('NIS')      // 👈 GANTI TAMPILAN DI TABEL
                    ->searchable(),

                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Siswa')
                    ->searchable(),

                Tables\Columns\TextColumn::make('email')
                    ->searchable(),

                Tables\Columns\TextColumn::make('no_telp')
                    ->label('No. Telp'),
            ])
            ->filters([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMahasiswas::route('/'),
            'create' => Pages\CreateMahasiswa::route('/create'),
            'edit' => Pages\EditMahasiswa::route('/{record}/edit'),
        ];
    }
}
