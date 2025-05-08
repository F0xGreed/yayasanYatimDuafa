<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function index()
    {
        $donations = Donation::latest()->paginate(10); // asumsinya modelnya bernama Donation
        return view('admin.donations.index', compact('donations'));
    }

}
