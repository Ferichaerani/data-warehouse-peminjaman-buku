<?php

namespace App\Filament\Resources\KembaliResource\Pages;

use App\Filament\Resources\KembaliResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKembalis extends ListRecords
{
    protected static string $resource = KembaliResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
