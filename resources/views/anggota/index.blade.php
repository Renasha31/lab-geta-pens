@extends('layout.app')
@section('title', 'Members')
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
    </style>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h2>Data Anggota</h2>
                <p class="text-muted">Kelola data anggota.</p>
            </div>
            <a href="{{ route('anggota.create') }}" class="btn btn-outline-primary rounded-pill px-4 shadow-sm">
                <i class="bi bi-plus-circle me-1"></i> Tambah Anggota
            </a>
        </div>

        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover table-bordered mb-0 table table-bordered">
                    <tr>
                        <th>No</th>
                        <th>Nama Anggota</th>
                        <th>Jenis Anggota</th>
                        <th>Tempat Tanggal Lahir</th>
                        <th>RPDK</th>
                        <th>Aksi</th>
                    </tr>

                    @forelse ($anggota as $index => $a)
                        <tr>
                            <td>{{ $anggota->firstItem() + $index }}</td>
                            <td>{{ $a->nama_anggota }}</td>
                            <td>{{ $a->jenis_anggota }}</td>
                            <td>{{ $a->ttl }}</td>
                            <td>{{ $a->rpdk }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('anggota.show', $a->id) }}"
                                        class="btn btn-sm btn-outline-primary">Show</a>
                                    <a href="{{ route('anggota.edit', $a->id) }}"
                                        class="btn btn-sm btn-outline-warning">Edit</a>
                                    <form action="{{ route('anggota.destroy', $a->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada data anggota.</td>
                        </tr>
                    @endforelse
                </table>
            </div>

            <div class="mt-3">
                {{ $anggota->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

@endsection
