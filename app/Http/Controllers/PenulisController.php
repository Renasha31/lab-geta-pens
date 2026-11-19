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
            return redirect('/');
        }

        return redirect('/login');
    }

    public function logout()
    {
        session()->flush();
        return redirect('/');
    }
}
