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
        <h2>{{ $terjemahkan('Tambah Anggota', 'crud_anggota_tambah') }}</h2>

        <div class="card mt-3">
            <form action="{{ route('anggota.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <label>{{ $terjemahkan('Nama Anggota', 'crud_nama_anggota') }}</label>
                <input type="text" name="nama_anggota" placeholder="{{ $terjemahkan('Nama Anggota', 'crud_placeholder_nama') }}" required class="form-control mb-3">

                <label>{{ $terjemahkan('Jenis Anggota', 'crud_jenis_anggota') }}</label>
                <input type="text" name="jenis_anggota" placeholder="{{ $terjemahkan('Dosen/Mahasiswa', 'crud_placeholder_jenis') }}" class="form-control mb-3">

                <label>{{ $terjemahkan('Tempat Tanggal Lahir', 'crud_ttl') }}</label>
                <input type="text" name="ttl" placeholder="{{ $terjemahkan('Tempat Tanggal Lahir', 'crud_placeholder_ttl') }}" required class="form-control mb-3">

                <label>{{ $terjemahkan('Foto Anggota', 'crud_foto_anggota') }}</label>
                <input type="file" name="image" required class="form-control mb-3">

                <label>{{ $terjemahkan('Riwayat Pendidikan dan Karir', 'crud_rpdk') }}</label>
                <textarea name="rpdk" placeholder="{{ $terjemahkan('Riwayat Pendidikan dan Karir', 'crud_placeholder_rpdk') }}" required rows="5" class="form-control mb-3"></textarea>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">{{ $terjemahkan('Simpan', 'crud_simpan') }}</button>
                    <a href="{{ route('anggota.index') }}" class="btn btn-secondary">{{ $terjemahkan('Kembali', 'crud_kembali') }}</a>
                </div>
            </form>
        </div>
    </div>

@endsection

