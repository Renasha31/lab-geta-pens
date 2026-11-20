<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function depanb()
    {
        $berita = Berita::latest()->take(5)->get();
        return view('berita.depanb', compact('berita'));
    }

    public function index()
    {
        if (!session()->has('key')) {
            return redirect()->route('login')->with('error', '');
        }

        $berita = Berita::paginate(5);
        return view('berita.index', compact('berita'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!session()->has('key')) {
            return redirect()->route('login')->with('error', '');
        }

        return view('berita.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $gambar = $request->file('gambar')->store('images', 'public');
        $input = $request->all();
        $input['gambar'] = "$gambar";
        $input['penulis_id'] = 1;

        Berita::create($input);
        return redirect()->route('berita.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $berita = Berita::findOrFail($id);
        return view('berita.show', compact('berita'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (!session()->has('key')) {
            return redirect()->route('login')->with('error', '');
        }

        $berita = Berita::findOrFail($id);
        return view('berita.edit', compact('berita'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $berita = Berita::findOrFail($id);

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('images', 'public');
            $berita->gambar = $gambar;
        }

        $berita->title = $request->title;
        $berita->konten = $request->konten;
        $berita->tgl = $request->tgl;
        $berita->save();

        return redirect()->route('berita.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Berita::destroy($id);
        return redirect()->back();
    }
}
