@extends('layout.app')
@section('title', 'Buat Berita')
@section('content')

    @php
        $terjemahkan = function ($teks, $key) {
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
    </style>

    <div class="container mt-4">
        <h2>{{ $terjemahkan('Buat Berita', 'crud_berita_buat') }}</h2>
        <div class="card mt-3">
            <form action="{{ route('berita.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <label>{{ $terjemahkan('Judul berita (Indonesia)', 'crud_berita_judul_id') }}</label>
                <input type="text" name="title"
                    placeholder="{{ $terjemahkan('Judul berita', 'crud_berita_placeholder_judul') }}"
                    required class="form-control mb-3">

                <label>{{ $terjemahkan('Judul berita (Inggris)', 'crud_berita_judul_en') }}</label>
                <input type="text" name="title_en" placeholder="News title in English"
                    class="form-control mb-3">

                <label>{{ $terjemahkan('Isi Berita', 'crud_berita_label_isi') }}</label>
                <textarea name="konten"
                    placeholder="{{ $terjemahkan('Isi Berita', 'crud_berita_placeholder_isi') }}"
                    required rows="5" class="form-control mb-3"></textarea>

                <label>{{ $terjemahkan('Tanggal', 'crud_berita_label_tanggal') }}</label>
                <input type="date" name="tgl" required class="form-control mb-3">

                <label>{{ $terjemahkan('Gambar Berita', 'crud_berita_label_gambar') }}</label>
                <input type="file" name="gambar" required class="form-control mb-3">

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        {{ $terjemahkan('Simpan', 'crud_berita_simpan') }}
                    </button>
                    <a href="{{ route('berita.index') }}" class="btn btn-secondary">
                        {{ $terjemahkan('Kembali', 'crud_berita_kembali') }}
                    </a>
                </div>
            </form>
        </div>
    </div>

@endsection
