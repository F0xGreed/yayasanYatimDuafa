<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donor;
use App\Models\User;

class DonorController extends Controller
{
    public function index()
    {
        $donors = Donor::all();
        $role = auth()->user()->role;

        // Ambil user publik yang berhasil register
        $publicUsers = User::where('role', 'anggota')->get(); // Ganti 'anggota' jika nama role berbeda

        return view("$role.donors.index", compact('donors', 'publicUsers'));
    }

    public function create()
    {
        $role = auth()->user()->role;
        return view("$role.donors.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'address' => 'nullable',
        ]);

        Donor::create($request->all());

        return redirect()->route('donors.index')->with('success', 'Donatur berhasil ditambahkan.');
    }

    public function edit(Donor $donor)
    {
        $role = auth()->user()->role;
        return view("$role.donors.edit", compact('donor'));
    }

    public function update(Request $request, Donor $donor)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'address' => 'nullable',
        ]);

        $donor->update($request->all());

        return redirect()->route('donors.index')->with('success', 'Data donatur berhasil diperbarui.');
    }

    public function destroy(Donor $donor)
    {
        $donor->delete();
        return redirect()->route('donors.index')->with('success', 'Donatur berhasil dihapus.');
    }
}
