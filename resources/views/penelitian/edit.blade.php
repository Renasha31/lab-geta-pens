@extends('layout.app')
@section('title', 'Edit Data Penelitian')
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
        <h2>Edit Data Penelitian</h2>

        <div class="card mt-3">
            <form action="{{ route('penelitian.update', $penelitian->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <input type="text" name="judul" placeholder="Judul" required class="form-control mb-3"
                    value="{{ $penelitian->judul }}">

                <textarea name="isi" placeholder="Isi Hasil Penelitian" required cols="30" rows="10"
                    class="form-control mb-3">{{ $penelitian->isi }}</textarea>

                <input type="date" name="tanggal" required class="form-control mb-3" value="{{ $penelitian->tanggal }}">

                <input type="text" name="peneliti" required placeholder="Anggota Peneliti" class="form-control mb-3"
                    value="{{ $penelitian->peneliti }}">

                <p>File sebelumnya adalah: <strong>{{ $penelitian->image }}</strong></p>

                <input type="file" name="image" required class="form-control mb-3">

                <button type="submit" class="btn btn-primary float-end">Simpan</button>
            </form>
        </div>
    </div>

@endsection
