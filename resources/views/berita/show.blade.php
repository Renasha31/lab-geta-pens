
@php
    $judul = $berita->title;
    $konten = $berita->konten;

    if (app()->getLocale() == 'en') {

        $judul = \Illuminate\Support\Facades\Cache::remember(
            'berita_judul_en_' . $berita->id . '_' . $berita->updated_at->timestamp,
            now()->addDays(30),
            function () use ($berita) {
                try {
                    $translator = new \Stichoza\GoogleTranslate\GoogleTranslate('en');
                    return $translator->translate($berita->title);
                } catch (\Throwable $e) {
                    return $berita->title;
                }
            }
        );

        $konten = \Illuminate\Support\Facades\Cache::remember(
            'berita_konten_en_' . $berita->id . '_' . $berita->updated_at->timestamp,
            now()->addDays(30),
            function () use ($berita) {
                try {
                    $translator = new \Stichoza\GoogleTranslate\GoogleTranslate('en');
                    return $translator->translate($berita->konten);
                } catch (\Throwable $e) {
                    return $berita->konten;
                }
            }
        );
    }
@endphp

@extends('layout.app')
@section('title', app()->getLocale() == 'en' ? 'News Detail' : 'Detail Berita')
@section('content')

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
            margin-bottom: 25px;
        }

        .research-image img {
            max-width: 100%;
            height: 300px;
            object-fit: contain;
        }

        .research-content {
            font-size: 18px;
            line-height: 1.9;
            color: #444;
            text-align: justify;
        }

        .research-meta {
            margin-top: 25px;
            font-size: 13px;
            color: #777;
            line-height: 1.8;
        }
    </style>

    <div class="research-detail">
        <h2>{{ $judul }}</h2>

        <div class="research-image">
            <img src="{{ url('storage/' . $berita->gambar) }}" alt="{{ $judul }}">
        </div>

        <div class="research-content">
            {!! nl2br(e($konten)) !!}
        </div>

        <div class="research-meta">
            <div>{{ $berita->tgl }}</div>
        </div>
    </div>

@endsection
