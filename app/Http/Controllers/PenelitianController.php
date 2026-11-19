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
        $penelitian = Penelitian::latest()->get();
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

        $image = $request->file('image')->store('images', 'public');
        $input = $request->all();
        $input['image'] = "$image";
        $input['penulis_id'] = 1;

        Penelitian::create($input);
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

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('images', 'public');
            $penelitian->image = $image;
        }

        $penelitian->judul = $request->judul;
        $penelitian->isi = $request->isi;
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
