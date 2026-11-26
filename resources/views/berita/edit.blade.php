
@extends('layout.app')
@section('title', 'Edit Berita')
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
        <h2>Edit Berita</h2>

        <div class="card mt-3">
            <form action="{{ route('berita.update', $berita->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <label>Judul Berita (Indonesia)</label>
                <input type="text" name="title" placeholder="Judul Berita" required class="form-control mb-3"
                    value="{{ $berita->title }}">

                <label>Judul Berita (Inggris)</label>
                <input type="text" name="title_en" placeholder="News title in English" class="form-control mb-3"
                    value="{{ $berita->title_en }}">

                <label>Isi Berita</label>
                <textarea name="konten" placeholder="Isi berita" required cols="30" rows="10"
                    class="form-control mb-3">{{ $berita->konten }}</textarea>

                <label>Tanggal</label>
                <input type="date" name="tgl" required class="form-control mb-3" value="{{ $berita->tgl }}">

                <p>File sebelumnya adalah: <strong>{{ $berita->gambar }}</strong></p>

                <label>Gambar Berita</label>
                <input type="file" name="gambar" class="form-control mb-3">

                <button type="submit" class="btn btn-primary float-end">Simpan</button>
            </form>
        </div>
    </div>

@endsection
