@extends('layout.app')
@section('title', 'Berita')
@section('content')

    @php
        $terjemahkan = function ($teks, $key) {
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
                <h2>{{ $terjemahkan('Data Berita', 'crud_berita_data') }}</h2>
                <p class="text-muted">{{ $terjemahkan('Kelola berita.', 'crud_berita_kelola') }}</p>
            </div>
            <a href="{{ route('berita.create') }}" class="btn btn-outline-primary rounded-pill px-4 shadow-sm">
                <i class="bi bi-plus-circle me-1"></i> {{ $terjemahkan('Tambah Berita', 'crud_berita_tambah') }}
            </a>
        </div>

        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover table-bordered mb-0 table table-bordered">
                    <tr>
                        <th>{{ $terjemahkan('No', 'crud_berita_no') }}</th>
                        <th>{{ $terjemahkan('Judul', 'crud_berita_judul') }}</th>
                        <th>{{ $terjemahkan('Isi Berita', 'crud_berita_isi') }}</th>
                        <th>{{ $terjemahkan('Tanggal', 'crud_berita_tanggal') }}</th>
                        <th>{{ $terjemahkan('Gambar', 'crud_berita_gambar') }}</th>
                        <th>{{ $terjemahkan('Aksi', 'crud_berita_aksi') }}</th>
                    </tr>

                    @forelse ($berita as $index => $b)
                        <tr>
                            <td>{{ $berita->firstItem() + $index }}</td>
                            <td>
                                {{ $terjemahkan($b->title, 'crud_berita_title_' . $b->id . '_' . $b->updated_at->timestamp) }}
                            </td>
                            <td>
                                {{ $terjemahkan(Str::limit($b->konten, 70, '...'), 'crud_berita_konten_' . $b->id . '_' . $b->updated_at->timestamp) }}
                            </td>
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
                                        class="btn btn-sm btn-outline-primary">
                                        {{ $terjemahkan('Show', 'crud_berita_show') }}
                                    </a>
                                    <a href="{{ route('berita.edit', $b->id) }}"
                                        class="btn btn-sm btn-outline-warning">
                                        {{ $terjemahkan('Edit', 'crud_berita_edit') }}
                                    </a>
                                    <form action="{{ route('berita.destroy', $b->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">
                                            {{ $terjemahkan('Hapus', 'crud_berita_hapus') }}
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">
                                {{ $terjemahkan('Belum ada berita terbaru.', 'crud_berita_kosong') }}
                            </td>
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
