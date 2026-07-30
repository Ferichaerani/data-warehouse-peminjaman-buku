<?php

namespace App\Filament\Resources\ReportResource\Pages;

use App\Filament\Resources\ReportResource;
use Filament\Resources\Pages\ListRecords;

class ListReports extends ListRecords
{
    protected static string $resource = ReportResource::class;

    // ❗️ PENTING: ini yang menghilangkan tombol "New"
    protected function getHeaderActions(): array
    {
        return [];
    }
}
