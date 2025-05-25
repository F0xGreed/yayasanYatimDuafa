<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RekapDonasiExport implements FromView
{
    protected $donations;

    public function __construct($donations)
    {
        $this->donations = $donations;
    }

    public function view(): View
    {
        return view('exports.excel', [
            'donations' => $this->donations
        ]);
    }
}
