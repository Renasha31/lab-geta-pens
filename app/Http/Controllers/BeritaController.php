<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;

class BeritaController extends Controller
{
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

    public function create()
    {
        if (!session()->has('key')) {
            return redirect()->route('login')->with('error', '');
        }

        return view('berita.create');
    }

    public function store(Request $request)
    {
        $gambar = $request->file('gambar')->store('images', 'public');

        $input = $request->all();
        $input['gambar'] = $gambar;
        $input['penulis_id'] = 1;

        Berita::create($input);

        return redirect()->route('berita.index');
    }

    public function show(string $id)
    {
        $berita = Berita::findOrFail($id);
        return view('berita.show', compact('berita'));
    }

    public function edit(string $id)
    {
        if (!session()->has('key')) {
            return redirect()->route('login')->with('error', '');
        }

        $berita = Berita::findOrFail($id);
        return view('berita.edit', compact('berita'));
    }

    public function update(Request $request, string $id)
    {
        $berita = Berita::findOrFail($id);

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('images', 'public');
            $berita->gambar = $gambar;
        }

        $berita->title = $request->title;
        $berita->title_en = $request->title_en;
        $berita->konten = $request->konten;
        $berita->tgl = $request->tgl;

        $berita->save();

        return redirect()->route('berita.index');
    }

    public function destroy(string $id)
    {
        Berita::destroy($id);
        return redirect()->back();
    }
}
