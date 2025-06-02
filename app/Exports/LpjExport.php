<?php

namespace App\Exports;

use App\Models\Lpj;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\View\View;

class LpjExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Lpj::all();
    }
     protected $lpj;

    public function __construct(Lpj $lpj)
    {
        $this->lpj = $lpj;
    }

    public function view(): View
    {
        return view('lpj.exports.excel', [
            'lpj' => $this->lpj
        ]);
    }
}
