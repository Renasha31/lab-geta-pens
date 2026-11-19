@extends('layout.app')
@section('title', 'Data Penelitian')
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
                <h2>Data Penelitian</h2>
                <p class="text-muted">Kelola data penelitian.</p>
            </div>
            <a href="{{ route('penelitian.create') }}" class="btn btn-outline-primary rounded-pill px-4 shadow-sm">
                <i class="bi bi-plus-circle me-1"></i> Tambah Penelitian
            </a>
        </div>

        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover table-bordered mb-0 table table-bordered">
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Isi</th>
                        <th>Tanggal</th>
                        <th>Peneliti</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>

                    @forelse ($penelitian as $index => $p)
                        <tr>
                            <td>{{ $penelitian->firstItem() + $index }}</td>
                            <td>{{ $p->judul }}</td>
                            <td>{{ Str::limit($p->isi, 70, '...') }}</td>
                            <td>{{ $p->tanggal }}</td>
                            <td>{{ $p->peneliti }}</td>
                            <td>
                                @if ($p->image)
                                    <img src="{{ asset('storage/' . $p->image) }}">
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('penelitian.show', $p->id) }}"
                                        class="btn btn-sm btn-outline-primary">Show</a>
                                    <a href="{{ route('penelitian.edit', $p->id) }}"
                                        class="btn btn-sm btn-outline-warning">Edit</a>
                                    <form action="{{ route('penelitian.destroy', $p->id) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin dihapus?')">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada data penelitian.</td>
                        </tr>
                    @endforelse
                </table>
            </div>

            <div class="mt-3">
                {{ $penelitian->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

@endsection
