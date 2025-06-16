<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PengeluaranExport;
use Barryvdh\DomPDF\Facade\Pdf;

class PengeluaranController extends Controller
{
    public function index(Request $request)
    {
        $role = auth()->user()->role;

        $query = Pengeluaran::query();

        if ($request->filled('tanggal_mulai')) {
            $query->whereDate('tanggal', '>=', $request->tanggal_mulai);
        }

        if ($request->filled('tanggal_selesai')) {
            $query->whereDate('tanggal', '<=', $request->tanggal_selesai);
        }

        $pengeluarans = $query->latest()->paginate(10);

        $view = $role === 'admin'
            ? 'admin.pengeluaran.index'
            : ($role === 'bendahara' ? 'bendahara.pengeluaran.index' : abort(403));

        return view($view, compact('pengeluarans'));
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(new PengeluaranExport($request), 'laporan_pengeluaran.xlsx');
    }

    public function exportPDF(Request $request)
    {
        $query = Pengeluaran::query();

        if ($request->filled('tanggal_mulai')) {
            $query->whereDate('tanggal', '>=', $request->tanggal_mulai);
        }

        if ($request->filled('tanggal_selesai')) {
            $query->whereDate('tanggal', '<=', $request->tanggal_selesai);
        }

        $pengeluarans = $query->latest()->get();
        $role = auth()->user()->role;

        $view = $role === 'admin'
            ? 'admin.pengeluaran.pdf'
            : ($role === 'bendahara' ? 'bendahara.pengeluaran.pdf' : abort(403));

        $pdf = Pdf::loadView($view, compact('pengeluarans'));
        return $pdf->stream('laporan_pengeluaran.pdf');
    }
    public function create()
{
    $view = auth()->user()->role === 'admin'
        ? 'admin.pengeluaran.create'
        : 'bendahara.pengeluaran.create';

    return view($view);
}

public function store(Request $request)
{
    $request->validate([
        'tanggal' => 'required|date',
        'deskripsi' => 'required|string|max:255',
        'jumlah' => 'required|numeric|min:0',
        'kategori' => 'required|string|max:100',
    ]);

    Pengeluaran::create($request->all());

    return redirect()->route('laporan-pengeluaran.index')->with('success', 'Pengeluaran berhasil ditambahkan.');
}

public function edit(Pengeluaran $pengeluaran)
{
    $view = auth()->user()->role === 'admin'
        ? 'admin.pengeluaran.edit'
        : 'bendahara.pengeluaran.edit';

    return view($view, compact('pengeluaran'));
}

public function update(Request $request, Pengeluaran $pengeluaran)
{
    $pengeluaran->update($request->all());

    return redirect()->route('laporan-pengeluaran.index')->with('success', 'Pengeluaran berhasil diperbarui.');
}



public function destroy(Pengeluaran $pengeluaran)
{
    $pengeluaran->delete();

    return redirect()->route('laporan-pengeluaran.index')->with('success', 'Pengeluaran berhasil dihapus.');
}

}
