@extends('layout.app')
@section('title', 'Buat Berita')
@section('content')

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
        <h2>Buat Berita</h2>
        <div class="card mt-3">
            <form action="{{ route('berita.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <label>Judul berita</label>
                <input type="text" name="title" placeholder="Judul berita" required class="form-control mb-3">

                <label>Isi Berita</label>
                <textarea name="konten" placeholder="Isi Berita" required rows="5" class="form-control mb-3"></textarea>

                <label>Tanggal</label>
                <input type="date" name="tgl" required class="form-control mb-3">

                <label>Gambar Berita</label>
                <input type="file" name="gambar" required class="form-control mb-3">

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('berita.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>

@endsection
