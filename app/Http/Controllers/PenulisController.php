<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penulis;

class PenulisController extends Controller
{
    public function index()
    {
        if (session()->has('key')) {
            return redirect('/');
        }

        return view('login');
    }

    public function login(Request $request)
    {
        $key = Penulis::where('username', $request->username)
            ->where('password', $request->password)
            ->get();

        if (!$key->isEmpty()) {
            session()->put('key', $key);
            return redirect('/')->with('success', 'Login berhasil!');
        }

        return redirect('/login')->with('error', 'Username atau password salah!');
    }

    public function logout()
    {
        session()->flush();
        return redirect('/')->with('success', 'Berhasil logout!');
    }
}
