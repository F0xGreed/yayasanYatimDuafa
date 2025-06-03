<?php

namespace App\Exports;

use App\Models\Pengeluaran;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Http\Request;

class PengeluaranExport implements FromView
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        $query = Pengeluaran::query();

        if ($this->request->filled('tanggal_mulai')) {
            $query->whereDate('tanggal', '>=', $this->request->tanggal_mulai);
        }

        if ($this->request->filled('tanggal_selesai')) {
            $query->whereDate('tanggal', '<=', $this->request->tanggal_selesai);
        }

        $pengeluarans = $query->latest()->get();

        $role = auth()->user()->role;

        return view($role === 'admin' ? 'admin.pengeluaran.excel' : 'bendahara.pengeluaran.excel', [
            'pengeluarans' => $pengeluarans
        ]);
    }
}

