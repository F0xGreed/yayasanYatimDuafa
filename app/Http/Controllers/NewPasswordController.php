<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;

class NewPasswordController extends Controller
{
    /**
     * Tampilkan form untuk membuat password baru.
     */
    public function create(Request $request)
    {
        return view('auth.reset-password', ['token' => $request->route('token')]);
    }

    /**
     * Simpan password baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        return $status == Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('success', 'Password berhasil diubah. Silahkan login kembali.')
                    : back()->withErrors(['email' => [__($status)]]);
    }
}
