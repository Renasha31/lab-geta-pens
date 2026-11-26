@extends('layout.app')
@section('title', 'Buat Data Penelitian')
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
        <h2>{{ $terjemahkan('Buat Data Penelitian', 'crud_penelitian_buat') }}</h2>
        <div class="card mt-3">
            <form action="{{ route('penelitian.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <label>{{ $terjemahkan('Judul Penelitian', 'crud_judul_penelitian') }}</label>
                <input type="text" name="judul" placeholder="{{ $terjemahkan('Judul Penelitian', 'crud_placeholder_judul') }}" required class="form-control mb-3">

                <label>{{ $terjemahkan('Isi Penelitian', 'crud_isi_penelitian') }}</label>
                <textarea name="isi" placeholder="{{ $terjemahkan('Isi Hasil Penelitian', 'crud_placeholder_isi') }}" required rows="5" class="form-control mb-3"></textarea>

                <label>{{ $terjemahkan('Gambar', 'crud_gambar') }}</label>
                <input type="file" name="image[]" accept="image/*"
                    class="form-control mb-2" required>

                <label>{{ $terjemahkan('Tanggal', 'crud_tanggal') }}</label>
                <input type="date" name="tanggal" required class="form-control mb-3">

                <label>{{ $terjemahkan('Anggota Peneliti', 'crud_anggota_peneliti') }}</label>
                <input type="text" name="peneliti" required placeholder="{{ $terjemahkan('Anggota Peneliti', 'crud_placeholder_peneliti') }}" class="form-control mb-3">

                <label>{{ $terjemahkan('Gambar Penelitian (Maks 4)', 'crud_gambar_maks') }}</label>

                @for ($i = 1; $i <= 4; $i++)
                    <label>{{ $terjemahkan('Gambar', 'crud_gambar') }} {{ $i }}</label>
                    <input type="file" name="image[]" accept="image/*"
                        class="form-control mb-2" required>

                    <label>{{ $terjemahkan('Deskripsi Gambar', 'crud_deskripsi_gambar') }} {{ $i }}</label>
                    <textarea name="deskripsi_foto[]"
                        class="form-control mb-3"
                        placeholder="{{ $terjemahkan('Deskripsi gambar', 'crud_placeholder_deskripsi') }} {{ $i }}" required></textarea>
                @endfor

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">{{ $terjemahkan('Simpan', 'crud_simpan') }}</button>
                    <a href="{{ route('penelitian.index') }}" class="btn btn-secondary">{{ $terjemahkan('Kembali', 'crud_kembali') }}</a>
                </div>
            </form>
        </div>
    </div>

@endsection

