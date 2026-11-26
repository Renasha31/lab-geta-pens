@extends('layout.app')
@section('title', 'Edit Berita')
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
        <h2>{{ $terjemahkan('Edit Berita', 'crud_berita_edit_heading') }}</h2>

        <div class="card mt-3">
            <form action="{{ route('berita.update', $berita->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <label>{{ $terjemahkan('Judul Berita (Indonesia)', 'crud_berita_edit_judul_id') }}</label>
                <input type="text" name="title"
                    placeholder="{{ $terjemahkan('Judul Berita', 'crud_berita_edit_placeholder_judul') }}"
                    required class="form-control mb-3" value="{{ $berita->title }}">

                <label>{{ $terjemahkan('Judul Berita (Inggris)', 'crud_berita_edit_judul_en') }}</label>
                <input type="text" name="title_en" placeholder="News title in English"
                    class="form-control mb-3" value="{{ $berita->title_en }}">

                <label>{{ $terjemahkan('Isi Berita', 'crud_berita_edit_label_isi') }}</label>
                <textarea name="konten"
                    placeholder="{{ $terjemahkan('Isi berita', 'crud_berita_edit_placeholder_isi') }}"
                    required cols="30" rows="10" class="form-control mb-3">{{ $berita->konten }}</textarea>

                <label>{{ $terjemahkan('Tanggal', 'crud_berita_edit_label_tanggal') }}</label>
                <input type="date" name="tgl" required class="form-control mb-3" value="{{ $berita->tgl }}">

                <p>{{ $terjemahkan('File sebelumnya adalah:', 'crud_berita_file_sebelumnya') }}
                    <strong>{{ $berita->gambar }}</strong>
                </p>

                <label>{{ $terjemahkan('Gambar Berita', 'crud_berita_edit_label_gambar') }}</label>
                <input type="file" name="gambar" class="form-control mb-3">

                <button type="submit" class="btn btn-primary float-end">
                    {{ $terjemahkan('Simpan', 'crud_berita_edit_simpan') }}
                </button>
            </form>
        </div>
    </div>

@endsection
