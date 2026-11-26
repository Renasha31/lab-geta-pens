@extends('layout.app')
@section('title', 'Buat Anggota')
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
        <h2>{{ $terjemahkan('Edit Anggota', 'crud_anggota_edit') }}</h2>

        <div class="card mt-3">
            <form action="{{ route('anggota.update', $anggota->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <label>{{ $terjemahkan('Nama Anggota', 'crud_nama_anggota') }}</label>
                <input type="text" name="nama_anggota" placeholder="{{ $terjemahkan('Nama Anggota', 'crud_placeholder_nama') }}" required class="form-control mb-3"
                    value="{{ $anggota->nama_anggota }}">

                <label>{{ $terjemahkan('Jenis Anggota', 'crud_jenis_anggota') }}</label>
                <input type="text" name="jenis_anggota" placeholder="{{ $terjemahkan('Kategori Anggota', 'crud_placeholder_kategori') }}" class="form-control mb-3"
                    value="{{ $anggota->jenis_anggota }}">

                <label>{{ $terjemahkan('Tempat Tanggal Lahir', 'crud_ttl') }}</label>
                <input type="text" name="ttl" required class="form-control mb-3" value="{{ $anggota->ttl }}">

                <p>{{ $terjemahkan('File sebelumnya adalah:', 'crud_file_sebelumnya') }} <strong>{{ $anggota->image }}</strong></p>

                <label>{{ $terjemahkan('Foto Anggota', 'crud_foto_anggota') }}</label>
                <input type="file" name="image" required class="form-control mb-3">

                <label>{{ $terjemahkan('Riwayat Pendidikan dan Karir', 'crud_rpdk') }}</label>
                <textarea name="rpdk" required cols="30" rows="10" class="form-control mb-3">{{ $anggota->rpdk }}</textarea>

                <button type="submit" class="btn btn-primary float-end">{{ $terjemahkan('Simpan', 'crud_simpan') }}</button>
            </form>
        </div>
    </div>

@endsection
