<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PublicDonation;
use App\Models\CampaignDonation;
use App\Models\Donor;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
{
    $user = Auth::user();
    $role = $user->role;

    $totalSaldo = PublicDonation::sum('nominal') + CampaignDonation::sum('nominal');
    $pendapatanBulanIni = PublicDonation::whereMonth('created_at', now()->month)
        ->whereYear('created_at', now()->year)
        ->sum('nominal')
        + CampaignDonation::whereMonth('created_at', now()->month)
        ->whereYear('created_at', now()->year)
        ->sum('nominal');

    $bulan = [];
    $totalPerBulan = [];
    for ($i = 0; $i < 12; $i++) {
        $date = now()->subMonths($i);
        $bulanLabel = $date->format('M Y');

        $total = PublicDonation::whereMonth('created_at', $date->month)
            ->whereYear('created_at', $date->year)
            ->sum('nominal')
            + CampaignDonation::whereMonth('created_at', $date->month)
            ->whereYear('created_at', $date->year)
            ->sum('nominal');

        $bulan[] = $bulanLabel;
        $totalPerBulan[] = $total;
    }

    $bulan = array_reverse($bulan);
    $totalPerBulan = array_reverse($totalPerBulan);

    $donasiTerbaru = PublicDonation::latest()->take(5)->get();
    $jumlahDonatur = \App\Models\Donor::count();
    $donasiTerakhir = PublicDonation::latest()->first()?->created_at;
    $totalDonasiKampanye = CampaignDonation::sum('nominal');

    if ($role === 'admin') {
        return view('admin.dashboard', compact(
            'totalSaldo',
            'pendapatanBulanIni',
            'bulan',
            'totalPerBulan',
            'donasiTerbaru',
            'jumlahDonatur',
            'donasiTerakhir'
        ));
    } elseif ($role === 'bendahara') {
        return view('bendahara.dashboard', compact(
            'totalSaldo',
            'bulan',
            'totalPerBulan',
            'donasiTerbaru',
            'totalDonasiKampanye'
        ));
    } else {
        return view('anggota.dashboard', compact(
            'totalSaldo',
            'donasiTerbaru'
        ));
    }
}
}
