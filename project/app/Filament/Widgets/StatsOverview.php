<?php

namespace App\Filament\Widgets;

use App\Models\Mahasiswa;
use App\Models\Buku;
use App\Models\Pinjam;
use App\Models\Kembali;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Siswa', Mahasiswa::count())   // ← DIUBAH
                ->description('Jumlah siswa terdaftar')    // ← DIUBAH
                ->icon('heroicon-o-user-group')
                ->color('primary'),

            Stat::make('Total Buku', Buku::count())
                ->description('Jumlah buku di perpustakaan')
                ->icon('heroicon-o-book-open')
                ->color('success'),

            Stat::make('Peminjaman Aktif', Pinjam::where('status', 'dipinjam')->count())
                ->description('Peminjaman yang belum dikembalikan')
                ->icon('heroicon-o-arrow-path')
                ->color('warning'),

            Stat::make('Total Pengembalian', Kembali::count())
                ->description('Jumlah buku yang telah dikembalikan')
                ->icon('heroicon-o-check-circle')
                ->color('info'),
        ];
    }
}
