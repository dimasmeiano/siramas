<?php
namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KeuanganExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct(Collection $data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data->map(function ($item) {
            return [
                $item->tanggal->format('d-m-Y'),
                $item->programKerja->nama ?? 'Umum',
                ucfirst($item->jenis),
                $item->nominal,
                $item->keterangan,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Program Kerja',
            'Jenis',
            'Nominal',
            'Keterangan',
        ];
    }
}
