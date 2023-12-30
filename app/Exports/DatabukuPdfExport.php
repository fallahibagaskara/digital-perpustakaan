<?php

namespace App\Exports;

use App\Models\Databuku;
use Maatwebsite\Excel\Concerns\FromCollection;

class DatabukuPdfExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $databuku = Databuku::all(['judul', 'kategori', 'deskripsi', 'jumlah']);

        return view('exports.databuku-pdf', [
            'databuku' => $databuku,
        ]);
    }
}
