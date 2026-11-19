
@extends('layout.app')
@section('title', 'Detail Penelitian')
@section('content')

@php
    $data = json_decode($penelitian->isi, true);

    // Mengatasi jika data JSON tersimpan dua kali
    if (is_string($data)) {
        $data = json_decode($data, true);
    }

    // Jika data berasal dari format lama
    if (!is_array($data) || !isset($data['isi_penelitian'])) {
        $data = [
            'isi_penelitian' => $penelitian->isi,
            'gambar' => [$penelitian->image],
            'deskripsi_foto' => [],
        ];
    }

    $gambar = $data['gambar'] ?? [];

    // Cadangan jika belum ada daftar gambar
    if (empty($gambar) && $penelitian->image) {
        $gambar = [$penelitian->image];
    }

    $deskripsi = $data['deskripsi_foto'] ?? [];
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

    .research-image {
        text-align: center;
        margin-bottom: 30px;
    }

    .research-image img {
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

    .research-content {
        font-size: 18px;
        line-height: 1.9;
        color: #444;
        text-align: justify;
        margin-top: 25px;
    }

    .research-meta {
        margin-top: 25px;
        font-size: 13px;
        color: #777;
        line-height: 1.8;
    }
</style>

<div class="research-detail">

    <h2>{{ $penelitian->judul }}</h2>

    {{-- Gambar penelitian --}}
    @foreach ($gambar as $index => $foto)
        <div class="research-image">
            <img
                src="{{ asset('storage/' . $foto) }}"
                alt="Gambar penelitian {{ $index + 1 }}"
            >

            <div class="image-description">
                {{ $deskripsi[$index] ?? '' }}
            </div>
        </div>
    @endforeach

    {{-- Isi penelitian --}}
    <div class="research-content">
        {!! nl2br(e($data['isi_penelitian'] ?? '')) !!}
    </div>

    {{-- Informasi penelitian --}}
    <div class="research-meta">
        <div>{{ $penelitian->tanggal }}</div>
        <div>{!! nl2br(e($penelitian->peneliti)) !!}</div>
    </div>

</div>

@endsection
