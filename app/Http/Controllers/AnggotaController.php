<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function adepan()
    { {
            $anggota = Anggota::latest()->get();
            return view('anggota.adepan', compact('anggota'));
        }
    }
    public function index()
    {
        if (!session()->has('key')) {
            return redirect()->route('login')->with('error', '');
        }

        $anggota = Anggota::paginate(5);
        return view('anggota.index', compact('anggota'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!session()->has('key')) {
            return redirect()->route('login')->with('error', '');
        }

        return view('anggota.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $image = $request->file('image')->store('images', 'public');
        $input = $request->all();
        $input['image'] = "$image";
        $input['penulis_id'] = 1;

        Anggota::create($input);
        return redirect()->route('anggota.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $anggota = Anggota::findOrFail($id);
        return view('anggota.show', compact('anggota'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (!session()->has('key')) {
            return redirect()->route('login')->with('error', '');
        }

        $anggota = Anggota::findOrFail($id);
        return view('anggota.edit', compact('anggota'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $anggota = Anggota::findOrFail($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('images', 'public');
            $anggota->image = $image;
        }

        $anggota->nama_anggota = $request->nama_anggota;
        $anggota->jenis_anggota = $request->jenis_anggota;
        $anggota->ttl = $request->ttl;
        $anggota->rpdk = $request->rpdk;
        $anggota->save();

        return redirect()->route('anggota.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Anggota::destroy($id);
        return redirect()->back();
    }
}
