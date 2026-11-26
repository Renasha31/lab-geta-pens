@extends('layout.app')
@section('title', 'Data Penelitian')
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
                <h2>{{ $terjemahkan('Data Penelitian', 'crud_penelitian_judul') }}</h2>
                <p class="text-muted">{{ $terjemahkan('Kelola data penelitian.', 'crud_penelitian_subjudul') }}</p>
            </div>
            <a href="{{ route('penelitian.create') }}" class="btn btn-outline-primary rounded-pill px-4 shadow-sm">
                <i class="bi bi-plus-circle me-1"></i> {{ $terjemahkan('Tambah Penelitian', 'crud_penelitian_tambah') }}
            </a>
        </div>

        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover table-bordered mb-0 table table-bordered">
                    <tr>
                        <th>{{ $terjemahkan('No', 'crud_no') }}</th>
                        <th>{{ $terjemahkan('Judul', 'crud_judul') }}</th>
                        <th>{{ $terjemahkan('Isi', 'crud_isi') }}</th>
                        <th>{{ $terjemahkan('Tanggal', 'crud_tanggal') }}</th>
                        <th>{{ $terjemahkan('Peneliti', 'crud_peneliti') }}</th>
                        <th>{{ $terjemahkan('Gambar', 'crud_gambar') }}</th>
                        <th>{{ $terjemahkan('Aksi', 'crud_aksi') }}</th>
                    </tr>

                    @forelse ($penelitian as $index => $p)
                        <tr>
                            <td>{{ $penelitian->firstItem() + $index }}</td>
                            <td>{{ $terjemahkan($p->judul, 'crud_penelitian_judul_' . $p->id . '_' . $p->updated_at->timestamp) }}</td>
                            <td>
                                @php
                                    $dataIsi = json_decode($p->isi, true);

                                    if (is_string($dataIsi)) {
                                        $dataIsi = json_decode($dataIsi, true);
                                    }

                                    $isiTampil = is_array($dataIsi)
                                        ? ($dataIsi['isi_penelitian'] ?? $p->isi)
                                        : $p->isi;
                                @endphp
                                {{ Str::limit($terjemahkan($isiTampil, 'crud_penelitian_isi_' . $p->id . '_' . $p->updated_at->timestamp), 70, '...') }}
                            </td>
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
                                        class="btn btn-sm btn-outline-primary">{{ $terjemahkan('Show', 'crud_show') }}</a>
                                    <a href="{{ route('penelitian.edit', $p->id) }}"
                                        class="btn btn-sm btn-outline-warning">{{ $terjemahkan('Edit', 'crud_edit') }}</a>
                                    <form action="{{ route('penelitian.destroy', $p->id) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" onclick="return confirm('{{ $terjemahkan('Yakin dihapus?', 'crud_hapus_confirm') }}')">{{ $terjemahkan('Hapus', 'crud_hapus') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">{{ $terjemahkan('Belum ada data penelitian.', 'crud_penelitian_kosong') }}</td>
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

