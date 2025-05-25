<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PublicDonation;
use Illuminate\Support\Facades\Response;
use App\Exports\PublicDonationsExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;


class DonationController extends Controller
{
    // Tampilkan daftar donasi dengan filter
    public function index(Request $request)
    {
        $query = PublicDonation::query();

        // Filter berdasarkan nama
        if ($request->filled('nama')) {
            $query->where('nama', 'like', '%' . $request->nama . '%');
        }

        // Filter berdasarkan tanggal
        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
            $query->whereBetween('created_at', [$request->tanggal_awal, $request->tanggal_akhir]);
        }

        $donations = $query->latest()->paginate(10)->withQueryString();
        $role = auth()->user()->role;

        return view("$role.donations.index", compact('donations'));
    }

    public function export(Request $request)
{
    $query = PublicDonation::query();

    if ($request->filled('nama')) {
        $query->where('nama', 'like', '%' . $request->nama . '%');
    }

    if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
        $query->whereBetween('created_at', [$request->tanggal_awal, $request->tanggal_akhir]);
    }

    $donations = $query->latest()->get();

    return Excel::download(new PublicDonationsExport($donations), 'rekap_donasi.xlsx');
}

public function exportPdf(Request $request)
{
    $query = PublicDonation::query();

    if ($request->filled('nama')) {
        $query->where('nama', 'like', '%' . $request->nama . '%');
    }

    if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
        $query->whereBetween('created_at', [$request->tanggal_awal, $request->tanggal_akhir]);
    }

    $donations = $query->latest()->get();

    // Dapatkan role pengguna login
    $role = auth()->user()->role;

    // Path view berdasarkan role
    $viewPath = $role . '.donations.pdf';

    // Load dan render PDF
    $pdf = Pdf::loadView($viewPath, compact('donations'))->setPaper('a4', 'landscape');

    return $pdf->stream('rekap_donasi_' . $role . '.pdf');
}

}
