<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use App\Models\PublicDonation;
use App\Models\CampaignDonation;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RekapDonasiExport;
use Barryvdh\DomPDF\Facade\Pdf;

class RekapDonasiController extends Controller
{
    public function index(Request $request)
{
    $publicDonations = PublicDonation::query();
    $campaignDonations = CampaignDonation::with('campaign');

    // Filter berdasarkan nama
    if ($request->filled('nama')) {
        $publicDonations->where('nama', 'like', '%' . $request->nama . '%');
        $campaignDonations->where('nama', 'like', '%' . $request->nama . '%');
    }

    // Filter berdasarkan tanggal
    if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
        $publicDonations->whereBetween('created_at', [
            $request->tanggal_awal . ' 00:00:00',
            $request->tanggal_akhir . ' 23:59:59'
        ]);
        $campaignDonations->whereBetween('created_at', [
            $request->tanggal_awal . ' 00:00:00',
            $request->tanggal_akhir . ' 23:59:59'
        ]);
    }

    // Ambil data & gabungkan
    $publicDonations = $publicDonations->get();
    $campaignDonations = $campaignDonations->get();

    $allDonations = $publicDonations->concat($campaignDonations)->sortByDesc('created_at');

    // Pagination manual (karena data hasil concat)
    $currentPage = request()->get('page', 1);
    $perPage = 10;
    $pagedData = $allDonations->slice(($currentPage - 1) * $perPage, $perPage)->all();
    $donations = new \Illuminate\Pagination\LengthAwarePaginator(
        $pagedData,
        $allDonations->count(),
        $perPage,
        $currentPage,
        ['path' => request()->url(), 'query' => request()->query()]
    );

    $totalNominal = $allDonations->sum('nominal');

    // Grafik bulanan dari public donations (optional bisa digabung nanti)
    $chartData = PublicDonation::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as bulan, SUM(nominal) as total')
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->get();

    return view(auth()->user()->role . '.rekap-donasi.index', compact('donations', 'totalNominal', 'chartData'));
}

    public function exportExcel(Request $request)
{
    $publicDonations = PublicDonation::query();
    $campaignDonations = CampaignDonation::with('campaign');

    // Filter
    if ($request->filled('nama')) {
        $publicDonations->where('nama', 'like', '%' . $request->nama . '%');
        $campaignDonations->where('nama', 'like', '%' . $request->nama . '%');
    }

    if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
        $publicDonations->whereBetween('created_at', [
            $request->tanggal_awal . ' 00:00:00',
            $request->tanggal_akhir . ' 23:59:59'
        ]);
        $campaignDonations->whereBetween('created_at', [
            $request->tanggal_awal . ' 00:00:00',
            $request->tanggal_akhir . ' 23:59:59'
        ]);
    }

    $donations = $publicDonations->get()->concat($campaignDonations->get());

    return Excel::download(new RekapDonasiExport($donations), 'rekap_donasi.xlsx');
}

public function exportPdf(Request $request)
{
    $publicDonations = PublicDonation::query();
    $campaignDonations = CampaignDonation::with('campaign');

    // Filter
    if ($request->filled('nama')) {
        $publicDonations->where('nama', 'like', '%' . $request->nama . '%');
        $campaignDonations->where('nama', 'like', '%' . $request->nama . '%');
    }

    if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
        $publicDonations->whereBetween('created_at', [
            $request->tanggal_awal . ' 00:00:00',
            $request->tanggal_akhir . ' 23:59:59'
        ]);
        $campaignDonations->whereBetween('created_at', [
            $request->tanggal_awal . ' 00:00:00',
            $request->tanggal_akhir . ' 23:59:59'
        ]);
    }

    $donations = $publicDonations->get()->concat($campaignDonations->get())->sortByDesc('created_at');

    $pdf = Pdf::loadView('exports.pdf', compact('donations'));
    return $pdf->download('rekap_donasi.pdf');
}


}
