<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
{
    $users = User::whereIn('role', ['admin', 'bendahara'])->paginate(10);
    return view('admin.users.index', compact('users'));
}

    
    public function create()
    {
        return view('admin.users.create');
    }
    
    // Simpan akun baru
    public function store(Request $request)
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'role'     => ['required', 'in:admin,bendahara,anggota'],
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'Akun berhasil dibuat.');
    }

    public function destroy(User $user)
    {
    $user->delete();
    return redirect()->route('users.index')->with('success', 'Akun berhasil dihapus.');
    }

    public function resetPassword(User $user)
{
    $newPassword = Str::random(8);
    $user->update([
        'password' => Hash::make($newPassword)
    ]);

    return redirect()->back()->with('success', "Password untuk {$user->name} berhasil direset ke: $newPassword");
}
}
