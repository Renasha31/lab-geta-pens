<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penelitian;

class PenelitianController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function depanp()
    {
        $penelitian = Penelitian::latest()->paginate(3);
        return view('penelitian.depanp', compact('penelitian'));
    }
    public function index()
    {
        if (!session()->has('key')) {
            return redirect()->route('login')->with('error', '');
        }

        $penelitian = Penelitian::paginate(5);
        return view('penelitian.index', compact('penelitian'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!session()->has('key')) {
            return redirect()->route('login')->with('error', '');
        }

        return view('penelitian.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'tanggal' => 'required|date',
            'peneliti' => 'required',
            'image' => 'required|array|max:5',
            'image.*' => 'image|mimes:jpg,jpeg,png,webp|max:10240',
            'deskripsi_foto' => 'required|array|max:5',
            'deskripsi_foto.*' => 'required|string',
        ]);

        $image = [];

        foreach ($request->file('image', []) as $foto) {
            if ($foto) {
                $image[] = $foto->store('images', 'public');
            }
        }

        $isi = [
            'isi_penelitian' => $request->isi,
            'gambar' =>$image,
            'deskripsi_foto' => $request->deskripsi_foto,
        ];

        Penelitian::create([
            'judul' => $request->judul,
            'isi'=> json_encode($isi),
            'tanggal' => $request->tanggal,
            'peneliti' => $request->peneliti,
            'image' => $image[0],
            'penulis_id' => 1,
        ]);

        return redirect()->route('penelitian.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $penelitian = Penelitian::findOrFail($id);
        return view('penelitian.show', compact('penelitian'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (!session()->has('key')) {
            return redirect()->route('login')->with('error', '');
        }

        $penelitian = Penelitian::findOrFail($id);
        return view('penelitian.edit', compact('penelitian'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $penelitian = Penelitian::findOrFail($id);

    $request->validate([
        'judul' => 'required',
        'isi' => 'required',
        'tanggal' => 'required|date',
        'peneliti' => 'required',
        'image' => 'nullable|array|max:5',
        'image.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        'gambar_lama' => 'nullable|array',
        'deskripsi_foto' => 'nullable|array|max:4',
        'deskripsi_foto.*' => 'nullable|string',
    ]);

    $dataLama = json_decode($penelitian->isi, true);

    if (is_string($dataLama)) {
        $dataLama = json_decode($dataLama, true);
    }

    $gambar = $dataLama['gambar'] ?? [$penelitian->image];
    $deskripsi = $dataLama['deskripsi_foto'] ?? [];

    foreach ($request->file('image', []) as $index => $foto) {
        if ($foto) {
            $gambar[$index] = $foto->store('images', 'public');
        }
    }

    if ($request->has('deskripsi_foto')) {
        $deskripsi = $request->deskripsi_foto;
    }

    $gambar = array_values($gambar);

    $isi = [
        'isi_penelitian' => $request->isi,
        'gambar' => $gambar,
        'deskripsi_foto' => array_values($deskripsi),
    ];

    $penelitian->judul = $request->judul;
    $penelitian->isi = json_encode($isi);
    $penelitian->image = $gambar[0] ?? $penelitian->image;
    $penelitian->tanggal = $request->tanggal;
    $penelitian->peneliti = $request->peneliti;

    $penelitian->save();

    return redirect()->route('penelitian.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Penelitian::destroy($id);
        return redirect()->back();
    }
}
