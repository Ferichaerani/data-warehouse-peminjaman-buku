<?php

namespace App\Http\Controllers;

use App\Models\Pinjam;
use Barryvdh\DomPDF\Facade\Pdf;

class PinjamPdfController extends Controller
{
    public function cetak($id)
    {
        $pinjam = Pinjam::with(['mahasiswa', 'buku'])->findOrFail($id);

        $pdf = Pdf::loadView('pdf.pinjam', compact('pinjam'))
                  ->setPaper('A4', 'portrait');

        return $pdf->stream('pinjam-'.$pinjam->id.'.pdf');
    }
}
