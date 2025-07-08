<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'username' => ['required','email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($request->only('username', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('sekretaris')) {
            return redirect()->route('sekretaris.dashboard');
        } elseif ($user->hasRole('bendahara')) {
            return redirect()->route('sekretaris.dashboard');
        }elseif ($user->hasRole('kontributor')) {
            return redirect()->route('sekretaris.dashboard');
        } else {
            return redirect()->route('anggota.chat');
        }
    }
}
