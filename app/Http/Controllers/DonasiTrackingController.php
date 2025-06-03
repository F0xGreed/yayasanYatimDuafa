<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PublicDonation;

class DonasiTrackingController extends Controller
{
    public function showForm()
{
    return view('public.donasi.tracking-form');
}

public function showResult(Request $request)
{
    $orderId = $request->get('order_id');

    $donation = \App\Models\PublicDonation::where('order_id', $orderId)->first();

    return view('public.donasi.tracking-result', compact('donation', 'orderId'));
}

}
