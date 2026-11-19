@extends('layout.app')
@section('title', 'Buat Data Penelitian')
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
        <h2>Buat Data Penelitian</h2>
        <div class="card mt-3">
            <form action="{{ route('penelitian.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <label>Judul Penelitian</label>
                <input type="text" name="judul" placeholder="Judul Penelitian" required class="form-control mb-3">

                <label>Isi Penelitian</label>
                <textarea name="isi" placeholder="Isi Hasil Penelitian" required rows="5" class="form-control mb-3"></textarea>

                <label>Gambar</label>
                    <input type="file" name="image[]" accept="image/*"
                        class="form-control mb-2" required>


                <label>Tanggal</label>
                <input type="date" name="tanggal" required class="form-control mb-3">

                <label>Anggota Peneliti</label>
                <input type="text" name="peneliti" required placeholder="Anggota Peneliti" class="form-control mb-3">


                <label>Gambar Penelitian (Maks 4)</label>

                @for ($i = 1; $i <= 4; $i++)
                    <label>Gambar {{ $i }}</label>
                    <input type="file" name="image[]" accept="image/*"
                        class="form-control mb-2" required>

                    <label>Deskripsi Gambar {{ $i }}</label>
                    <textarea name="deskripsi_foto[]"
                        class="form-control mb-3"
                        placeholder="Deskripsi gambar {{ $i }}" required></textarea>
                @endfor

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('penelitian.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>

@endsection
