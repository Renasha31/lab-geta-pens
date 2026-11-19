
@extends('layout.app')
@section('title', 'Detail Penelitian')
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
    $deskripsi = $data['deskripsi_foto'] ?? [];

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

    <h2>{{ $penelitian->judul }}</h2>

    {{-- Foto utama --}}
    @if (isset($gambar[0]))
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

    {{-- Foto lainnya --}}
    @for ($i = 1; $i < count($gambar); $i++)
        <div class="other-image">
            <img
                src="{{ asset('storage/' . $gambar[$i]) }}"
                alt="Gambar penelitian {{ $i + 1 }}"
            >

            <div class="image-description">
                {{ $deskripsi[$i] ?? '' }}
            </div>
        </div>
    @endfor

    <div class="research-meta">
        <div>{{ $penelitian->tanggal }}</div>
        <div>{!! nl2br(e($penelitian->peneliti)) !!}</div>
    </div>

</div>

@endsection
