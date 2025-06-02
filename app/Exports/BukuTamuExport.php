<?php

namespace App\Exports;

use App\Models\BukuTamu;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BukuTamuExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
         return BukuTamu::select('nama', 'instansi', 'kontak', 'keperluan', 'waktu_kunjungan')
        ->get()
        ->map(function ($item) {
            return [
                'nama' => $item->nama,
                'instansi' => $item->instansi,
                'kontak' => $item->kontak,
                'keperluan' => $item->keperluan,
                'waktu_kunjungan' => \Carbon\Carbon::parse($item->waktu_kunjungan)->format('d-m-Y H:i'),
            ];
        });
    }

    public function headings(): array
    {
        return ['Nama', 'Instansi', 'Kontak',  'Keperluan', 'Tanggal Kunjungan'];
    }
}
