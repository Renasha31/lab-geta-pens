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
        <h2>Tambah Anggota</h2>

        <div class="card mt-3">
            <form action="{{ route('anggota.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <label>Nama Anggota</label>
                <input type="text" name="nama_anggota" placeholder="Nama Anggota" required class="form-control mb-3">

                <label>Jenis Anggota</label>
                <input type="text" name="jenis_anggota" placeholder="Dosen/Mahasiswa" class="form-control mb-3">

                <label>Tempat Tanggal Lahir</label>
                <input type="text" name="ttl" placeholder="Tempat Tanggal Lahir" required class="form-control mb-3">

                <label>Foto Anggota</label>
                <input type="file" name="image" required class="form-control mb-3">

                <label>Riwayat Pendidikan dan Karir</label>
                <textarea name="rpdk" placeholder="Riwayat Pendidikan dan Karir" required rows="5" class="form-control mb-3"></textarea>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('anggota.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>

@endsection
