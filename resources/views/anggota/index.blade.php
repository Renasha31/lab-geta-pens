@extends('layout.app')
@section('title', 'Members')
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

    <div class="mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h2>{{ $terjemahkan('Data Anggota', 'crud_anggota_judul') }}</h2>
                <p class="text-muted">{{ $terjemahkan('Kelola data anggota.', 'crud_anggota_subjudul') }}</p>
            </div>
            <a href="{{ route('anggota.create') }}" class="btn btn-outline-primary rounded-pill px-4 shadow-sm">
                <i class="bi bi-plus-circle me-1"></i> {{ $terjemahkan('Tambah Anggota', 'crud_anggota_tambah') }}
            </a>
        </div>

        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover table-bordered mb-0 table table-bordered">
                    <tr>
                        <th>{{ $terjemahkan('No', 'crud_no') }}</th>
                        <th>{{ $terjemahkan('Nama Anggota', 'crud_nama_anggota') }}</th>
                        <th>{{ $terjemahkan('Jenis Anggota', 'crud_jenis_anggota') }}</th>
                        <th>{{ $terjemahkan('Tempat Tanggal Lahir', 'crud_ttl') }}</th>
                        <th>{{ $terjemahkan('Riwayat Pendidikan Dan Karir', 'crud_rpdk') }}</th>
                        <th>{{ $terjemahkan('Aksi', 'crud_aksi') }}</th>
                    </tr>

                    @forelse ($anggota as $index => $a)
                        <tr>
                            <td>{{ $anggota->firstItem() + $index }}</td>
                            <td>{{ $a->nama_anggota }}</td>
                            <td>{{ $terjemahkan($a->jenis_anggota, 'anggota_jenis_' . $a->id . '_' . $a->updated_at->timestamp) }}</td>
                            <td>{{ $terjemahkan($a->ttl, 'anggota_ttl_' . $a->id . '_' . $a->updated_at->timestamp) }}</td>
                            <td>{{ $terjemahkan($a->rpdk, 'anggota_rpdk_' . $a->id . '_' . $a->updated_at->timestamp) }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('anggota.show', $a->id) }}"
                                        class="btn btn-sm btn-outline-primary">{{ $terjemahkan('Show', 'crud_show') }}</a>
                                    <a href="{{ route('anggota.edit', $a->id) }}"
                                        class="btn btn-sm btn-outline-warning">{{ $terjemahkan('Edit', 'crud_edit') }}</a>
                                    <form action="{{ route('anggota.destroy', $a->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">{{ $terjemahkan('Hapus', 'crud_hapus') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">{{ $terjemahkan('Belum ada data anggota.', 'crud_anggota_kosong') }}</td>
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

