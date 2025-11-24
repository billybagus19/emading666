<?php

namespace App\Exports;

use App\Models\Artikel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ArtikelExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Artikel::where('status', 'published')
            ->with(['user', 'kategori'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Judul Artikel',
            'Penulis',
            'Kategori',
            'Tanggal Publish',
            'Isi Artikel'
        ];
    }

    public function map($artikel): array
    {
        static $no = 0;
        $no++;
        
        return [
            $no,
            $artikel->judul,
            $artikel->user->nama,
            $artikel->kategori->nama_kategori,
            $artikel->created_at->format('d/m/Y'),
            strip_tags($artikel->isi)
        ];
    }
}