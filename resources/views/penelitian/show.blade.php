
@extends('layout.app')
@section('title', 'Detail Penelitian')
@section('content')

@php
    // Membaca data penelitian
    $data = json_decode($penelitian->isi, true);

    // Jika JSON tersimpan lebih dari satu kali
    for ($i = 0; $i < 3 && is_string($data); $i++) {
        $data = json_decode($data, true);
    }

    // Memeriksa kemungkinan data gambar tersimpan
    // di dalam isi_penelitian
    if (
        is_array($data) &&
        isset($data['isi_penelitian']) &&
        is_string($data['isi_penelitian'])
    ) {
        $dataDalam = json_decode($data['isi_penelitian'], true);

        if (
            is_array($dataDalam) &&
            isset($dataDalam['gambar'])
        ) {
            $data = $dataDalam;
        }
    }

    // Format untuk data lama
    if (!is_array($data) || !isset($data['isi_penelitian'])) {
        $data = [
            'isi_penelitian' => $penelitian->isi,
            'gambar' => [$penelitian->image],
            'deskripsi_foto' => [],
        ];
    }

    $gambar = $data['gambar'] ?? [];
    $deskripsi = $data['deskripsi_foto'] ?? [];

    if (!is_array($gambar)) {
        $gambar = [];
    }

    if (!is_array($deskripsi)) {
        $deskripsi = [];
    }

    // Cadangan foto utama untuk data lama
    if (empty($gambar) && $penelitian->image) {
        $gambar = [$penelitian->image];
    }
@endphp

<style>
    .research-detail {
        max-width: 1100px;
        margin: 20px auto;
        font-family: Arial, sans-serif;
        color: #333;
    }

    .research-detail h2 {
        font-size: 27px;
        font-weight: 500;
        line-height: 1.5;
        margin-bottom: 25px;
    }

    .main-image {
        text-align: center;
        margin-bottom: 30px;
    }

    .main-image img {
        width: 100%;
        max-height: 450px;
        object-fit: contain;
        border-radius: 10px;
    }

    .research-content {
        font-size: 18px;
        line-height: 1.9;
        color: #444;
        text-align: justify;
        margin-bottom: 30px;
    }

    .other-image {
        margin-bottom: 30px;
        text-align: center;
    }

    .other-image img {
        max-width: 100%;
        height: 300px;
        object-fit: contain;
        border-radius: 10px;
    }

    .image-description {
        margin-top: 10px;
        font-size: 15px;
        color: #666;
    }

    .research-meta {
        margin-top: 25px;
        font-size: 13px;
        color: #777;
        line-height: 1.8;
    }
</style>

<div class="research-detail">

    {{-- Judul penelitian --}}
    <h2>{{ $penelitian->judul }}</h2>

    {{-- Foto utama --}}
    @if (!empty($gambar[0]))
        <div class="main-image">
            <img
                src="{{ asset('storage/' . $gambar[0]) }}"
                alt="{{ $penelitian->judul }}"
            >
        </div>
    @endif

    {{-- Isi penelitian --}}
    <div class="research-content">
        {!! nl2br(e($data['isi_penelitian'] ?? '')) !!}
    </div>

    {{-- Empat foto tambahan dan deskripsinya --}}
    @foreach ($gambar as $index => $foto)
        @if ($index > 0)
            <div class="other-image">

                <img
                    src="{{ asset('storage/' . $foto) }}"
                    alt="Gambar penelitian {{ $index + 1 }}"
                >

                <div class="image-description">
                    {{ $deskripsi[$index - 1] ?? '' }}
                </div>

            </div>
        @endif
    @endforeach

    {{-- Informasi penelitian --}}
    <div class="research-meta">
        <div>{{ $penelitian->tanggal }}</div>

        <div>
            {!! nl2br(e($penelitian->peneliti)) !!}
        </div>
    </div>

</div>

@endsection
