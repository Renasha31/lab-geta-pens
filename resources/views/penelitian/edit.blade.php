@extends('layout.app')
@section('title', 'Edit Data Penelitian')
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

    $data = json_decode($penelitian->isi, true);

    if (is_string($data)) {
        $data = json_decode($data, true);
    }

    if (!is_array($data) || !isset($data['isi_penelitian'])) {
        $data = [
            'isi_penelitian' => $penelitian->isi,
            'gambar' => [$penelitian->image],
            'deskripsi_foto' => [],
        ];
    }

    $gambar = $data['gambar'] ?? [];
    $deskripsi = $data['deskripsi_foto'] ?? [];

    if (empty($gambar) && $penelitian->image) {
        $gambar = [$penelitian->image];
    }
@endphp

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

    .preview-image {
        max-width: 250px;
        max-height: 180px;
        object-fit: contain;
        display: block;
        margin: 10px 0;
    }
</style>

<div class="container mt-4">
    <h2>{{ $terjemahkan('Edit Data Penelitian', 'crud_penelitian_edit') }}</h2>

    <div class="card mt-3">
        <form action="{{ route('penelitian.update', $penelitian->id) }}"
            method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>{{ $terjemahkan('Gagal menyimpan:', 'crud_gagal_simpan') }}</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <label>{{ $terjemahkan('Judul Penelitian', 'crud_judul_penelitian') }}</label>
            <input type="text" name="judul"
                value="{{ old('judul', $penelitian->judul) }}"
                required class="form-control mb-3">

            <label>{{ $terjemahkan('Isi Penelitian', 'crud_isi_penelitian') }}</label>
            <textarea name="isi" rows="5" required
                class="form-control mb-3">{{ old('isi', $data['isi_penelitian'] ?? '') }}</textarea>

            <label>{{ $terjemahkan('Tanggal Penelitian', 'crud_tanggal') }}</label>
            <input type="date" name="tanggal"
                value="{{ old('tanggal', $penelitian->tanggal) }}"
                required class="form-control mb-3">

            <label>{{ $terjemahkan('Anggota Peneliti', 'crud_anggota_peneliti') }}</label>
            <input type="text" name="peneliti"
                value="{{ old('peneliti', $penelitian->peneliti) }}"
                required class="form-control mb-3">

            <hr>

            <label>{{ $terjemahkan('Dokumentasi Penelitian (Maksimal 4 Gambar)', 'crud_gambar_maksimal') }}</label>
            <p>{{ $terjemahkan('Gambar lama akan tetap digunakan jika tidak diganti. Deskripsi gambar boleh dikosongkan.', 'crud_petunjuk_edit_gambar') }}</p>

            @for ($i = 0; $i < 4; $i++)

                <label>
                    {{ $terjemahkan('Gambar', 'crud_gambar') }} {{ $i + 1 }}
                    @if ($i == 0)
                        ({{ $terjemahkan('Foto Utama', 'crud_foto_utama') }})
                    @else
                        ({{ $terjemahkan('Opsional', 'crud_opsional') }})
                    @endif
                </label>

                @if (isset($gambar[$i]))
                    <img src="{{ asset('storage/' . $gambar[$i]) }}"
                        class="preview-image"
                        alt="Gambar {{ $i + 1 }}">
                @endif

                <input type="file"
                    name="image[{{ $i }}]"
                    accept="image/*"
                    class="form-control mb-2">

                <label>{{ $terjemahkan('Deskripsi Gambar', 'crud_deskripsi_gambar') }} {{ $i + 1 }} ({{ $terjemahkan('Opsional', 'crud_opsional') }})</label>

                <textarea name="deskripsi_foto[{{ $i }}]"
                    class="form-control mb-3"
                    placeholder="{{ $terjemahkan('Tuliskan keterangan gambar jika diperlukan', 'crud_placeholder_deskripsi') }}">{{ old('deskripsi_foto.' . $i, $deskripsi[$i] ?? '') }}</textarea>

            @endfor

            <div class="text-end">
                <button type="submit" class="btn btn-primary">
                    {{ $terjemahkan('Simpan', 'crud_simpan') }}
                </button>

                <a href="{{ route('penelitian.index') }}"
                    class="btn btn-secondary">
                    {{ $terjemahkan('Kembali', 'crud_kembali') }}
                </a>
            </div>

        </form>
    </div>
</div>

@endsection
