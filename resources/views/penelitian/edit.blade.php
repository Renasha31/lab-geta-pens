
@extends('layout.app')
@section('title', 'Edit Data Penelitian')
@section('content')

@php
    $data = json_decode($penelitian->isi, true);

    if (is_string($data)) {
        $data = json_decode($data, true);
    }

    if (!is_array($data) || !isset($data['isi_penelitian'])) {
        $data = [
            'isi_penelitian' => $penelitian->isi,
            'gambar' => [$penelitian->image],
            'deskripsi_foto' => [],
        ];
    }

    $gambar = $data['gambar'] ?? [];

    if (empty($gambar) && $penelitian->image) {
        $gambar = [$penelitian->image];
    }

    $deskripsi = $data['deskripsi_foto'] ?? [];
@endphp

<style>
    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 2px 10px #ddd;
        padding: 25px;
    }

    h2 {
        font-weight: 600;
        color: #344054;
    }

    .preview-image {
        max-width: 250px;
        max-height: 180px;
        object-fit: contain;
        display: block;
        margin: 10px 0;
        border-radius: 8px;
    }
</style>

<div class="container mt-4">
    <h2>Edit Data Penelitian</h2>

    <div class="card mt-3">

        <form action="{{ route('penelitian.update', $penelitian->id) }}"
            method="post" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <label>Judul Penelitian</label>
            <input type="text" name="judul"
                value="{{ $penelitian->judul }}"
                required class="form-control mb-3">

            <label>Isi Penelitian</label>
            <textarea name="isi" rows="5" required
                class="form-control mb-3">{{ $data['isi_penelitian'] ?? '' }}</textarea>

            {{-- FOTO UTAMA --}}
            <label>Foto Utama</label>

            @if (isset($gambar[0]))
                <img src="{{ asset('storage/' . $gambar[0]) }}"
                    class="preview-image" alt="Foto utama">
            @endif

            <input type="hidden" name="gambar_lama[0]"
                value="{{ $gambar[0] ?? '' }}">

            <input type="file" name="image[0]"
                accept="image/*" class="form-control mb-3">

            <label>Tanggal</label>
            <input type="date" name="tanggal"
                value="{{ $penelitian->tanggal }}"
                required class="form-control mb-3">

            <label>Anggota Peneliti</label>
            <input type="text" name="peneliti"
                value="{{ $penelitian->peneliti }}"
                required class="form-control mb-3">

            <hr>

            <h5>Gambar Penelitian (Maksimal 4)</h5>

            @for ($i = 1; $i <= 4; $i++)

                <label>Gambar {{ $i }}</label>

                @if (isset($gambar[$i]))
                    <img src="{{ asset('storage/' . $gambar[$i]) }}"
                        class="preview-image"
                        alt="Gambar {{ $i + 1 }}">
                @endif

                <input type="hidden"
                    name="gambar_lama[{{ $i }}]"
                    value="{{ $gambar[$i] ?? '' }}">

                <input type="file"
                    name="image[{{ $i }}]"
                    accept="image/*"
                    class="form-control mb-2">

                <label>Deskripsi Gambar {{ $i }}</label>

                <textarea name="deskripsi_foto[]"
                    class="form-control mb-3"
                    placeholder="Deskripsi gambar {{ $i }}">{{ $deskripsi[$i - 1] ?? '' }}</textarea>

            @endfor

            <div class="text-end">
                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>

                <a href="{{ route('penelitian.index') }}"
                    class="btn btn-secondary">
                    Kembali
                </a>
            </div>

        </form>
    </div>
</div>

@endsection
