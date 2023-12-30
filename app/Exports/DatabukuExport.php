<?php

namespace App\Exports;

use App\Models\Databuku;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class DatabukuExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array{
        return[
            'Judul',
            'Kategori',
            'Deskripsi',
            'Jumlah',
        ];
    } 
    public function collection()
    {
        return Databuku::all()->map(function ($item) {
            return [
                'Judul' => $item->judul,
                'Kategori' => $item->kategori,
                'Deskripsi' => $item->deskripsi,
                'Jumlah' => $item->jumlah,
            ];
        });
    }
}
