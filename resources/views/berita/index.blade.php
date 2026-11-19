@extends('layout.app')
@section('title', 'Berita')
@section('content')

    <style>
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px #ddd;
            padding: 20px;
        }

        h2 {
            font-weight: 600;
            color: #344054;
        }

        th {
            background: #f4f6f8 !important;
            color: #555 !important;
        }

        td,
        th {
            padding: 13px !important;
            vertical-align: middle;
            font-size: 14px;
        }

        img {
            width: 65px;
            height: 45px;
            object-fit: cover;
            border-radius: 5px;
        }
    </style>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h2>Data Berita</h2>
                <p class="text-muted">Kelola berita.</p>
            </div>
            <a href="{{ route('berita.create') }}" class="btn btn-outline-primary rounded-pill px-4 shadow-sm">
                <i class="bi bi-plus-circle me-1"></i> Tambah Berita
            </a>
        </div>

        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover table-bordered mb-0 table table-bordered">
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Isi Berita</th>
                        <th>Tanggal</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>

                    @forelse ($berita as $index => $b)
                        <tr>
                            <td>{{ $berita->firstItem() + $index }}</td>
                            <td>{{ $b->title }}</td>
                            <td>{{ Str::limit($b->konten, 70, '...') }}</td>
                            <td>{{ $b->tgl }}</td>
                            <td>
                                @if ($b->gambar)
                                    <img src="{{ asset('storage/' . $b->gambar) }}">
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('berita.show', $b->id) }}"
                                        class="btn btn-sm btn-outline-primary">Show</a>
                                    <a href="{{ route('berita.edit', $b->id) }}"
                                        class="btn btn-sm btn-outline-warning">Edit</a>
                                    <form action="{{ route('berita.destroy', $b->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada berita terbaru.</td>
                        </tr>
                    @endforelse
                </table>
            </div>

            <div class="mt-3">
                {{ $berita->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

@endsection
