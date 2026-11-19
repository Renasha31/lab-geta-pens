@extends('layout.app')
@section('title', 'Buat Anggota')
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
        <h2>Edit Anggota</h2>

        <div class="card mt-3">
            <form action="{{ route('anggota.update', $anggota->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <input type="text" name="nama_anggota" placeholder="Nama Anggota" required class="form-control mb-3"
                    value="{{ $anggota->nama_anggota }}">

                <input type="text" name="jenis_anggota" placeholder="Kategori Anggota" class="form-control mb-3"
                    value="{{ $anggota->jenis_anggota }}">

                <input type="text" name="ttl" required class="form-control mb-3" value="{{ $anggota->ttl }}">

                <p>File sebelumnya adalah: <strong>{{ $anggota->image }}</strong></p>

                <input type="file" name="image" required class="form-control mb-3">

                <textarea name="rpdk" required cols="30" rows="10" class="form-control mb-3">{{ $anggota->rpdk }}</textarea>

                <button type="submit" class="btn btn-primary float-end">Simpan</button>
            </form>
        </div>
    </div>

@endsection
