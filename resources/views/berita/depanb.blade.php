@extends('layout.app')
@section('page-title', 'Berita')
@section('content')

@php
    $terjemahkan = function($teks, $key) {
        if (app()->getLocale() != 'en' || empty($teks)) {
            return $teks;
        }

        return \Illuminate\Support\Facades\Cache::remember(
            $key,
            now()->addDays(30),
            function () use ($teks) {
                try {
                    $translator = new \Stichoza\GoogleTranslate\GoogleTranslate('en');
                    return $translator->translate($teks);
                } catch (\Throwable $e) {
                    return $teks;
                }
            }
        );
    };

    $judulHalaman = $terjemahkan('Daftar Berita', 'berita_judul_en');
    $belumAda = $terjemahkan('belum ada berita', 'berita_kosong_en');
@endphp

    <div class="container mt-5">
        <h3>{{ $judulHalaman }} : </h3>
        <hr>

        <ol>
            @forelse ($berita as $b)
                <p>
                    <li style="font-size: 150%">
                        <a href="{{ route('berita.show', $b->id) }}" style="text-decoration: none; color: black;">
                            {{ $terjemahkan($b->title, 'berita_title_' . $b->id . '_' . $b->updated_at->timestamp) }}
                        </a>
                    </li>
                </p>
            @empty
                <p>{{ $belumAda }}</p>
            @endforelse
        </ol>
    </div>

@endsection

