
@extends('layout.app')
@section('title', app()->getLocale() == 'en' ? 'Research Detail' : 'Detail Penelitian')
@section('content')

@php
    use Illuminate\Support\Facades\Cache;
    use Stichoza\GoogleTranslate\GoogleTranslate;

    $terjemahkan = function ($teks, $key) {
        if (app()->getLocale() != 'en' || empty($teks)) {
            return $teks;
        }

        return Cache::remember(
            $key,
            now()->addDays(30),
            function () use ($teks) {
                try {
                    $translator = new GoogleTranslate('en');
                    return $translator->translate($teks);
                } catch (\Throwable $e) {
                    return $teks;
                }
            }
        );
    };

    $data = json_decode($penelitian->isi, true);

    for ($i = 0; $i < 3 && is_string($data); $i++) {
        $data = json_decode($data, true);
    }

    if (
        is_array($data) &&
        isset($data['isi_penelitian']) &&
        is_string($data['isi_penelitian'])
    ) {
        $dataDalam = json_decode($data['isi_penelitian'], true);

        if (is_array($dataDalam) && isset($dataDalam['gambar'])) {
            $data = $dataDalam;
        }
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

    if (!is_array($gambar)) {
        $gambar = [];
    }

    if (!is_array($deskripsi)) {
        $deskripsi = [];
    }

    if (empty($gambar) && $penelitian->image) {
        $gambar = [$penelitian->image];
    }

    $judul = $terjemahkan(
        $penelitian->judul,
        'penelitian_judul_en_' . $penelitian->id . '_' . $penelitian->updated_at->timestamp
    );

    $isiPenelitian = $terjemahkan(
        $data['isi_penelitian'] ?? '',
        'penelitian_isi_en_' . $penelitian->id . '_' . $penelitian->updated_at->timestamp
    );

    $deskripsiTerjemahan = [];

    foreach ($deskripsi as $index => $isiDeskripsi) {
        $deskripsiTerjemahan[$index] = $terjemahkan(
            $isiDeskripsi,
            'penelitian_deskripsi_en_' . $penelitian->id . '_' . $index . '_' . $penelitian->updated_at->timestamp
        );
    }
@endphp

<style>
    .research-detail {
        max-width: 1100px;
        margin: 20px auto;
        font-family: Arial, sans-serif;
        color: #333;
    }

    .research-detail h2 {
        font-size: 27px;
        font-weight: 500;
        line-height: 1.5;
        margin-bottom: 25px;
    }

    .main-image {
        text-align: center;
        margin-bottom: 30px;
    }

    .main-image img {
        width: 100%;
        max-height: 450px;
        object-fit: contain;
    }

    .research-content {
        font-size: 18px;
        line-height: 1.9;
        color: #444;
        text-align: justify;
        margin-bottom: 30px;
    }

    .other-image {
        margin-bottom: 30px;
        text-align: center;
    }

    .other-image img {
        max-width: 100%;
        height: 300px;
        object-fit: contain;
    }

    .image-description {
        margin-top: 10px;
        font-size: 15px;
        color: #444;
    }

    .research-meta {
        margin-top: 25px;
        font-size: 13px;
        color: #444;
        line-height: 1.8;
    }
</style>

<div class="research-detail">

    <h2>{{ $judul }}</h2>

    @if (!empty($gambar[0]))
        <div class="main-image">
            <img
                src="{{ asset('storage/' . $gambar[0]) }}"
                alt="{{ $judul }}"
            >
        </div>
    @endif

    <div class="research-content">
        {!! nl2br(e($isiPenelitian)) !!}
    </div>

    @foreach ($gambar as $index => $foto)
        @if ($index > 0)
            <div class="other-image">

                <img
                    src="{{ asset('storage/' . $foto) }}"
                    alt="Research image {{ $index + 1 }}"
                >

                <div class="image-description">
                    {{ $deskripsiTerjemahan[$index - 1] ?? ($deskripsi[$index - 1] ?? '') }}
                </div>

            </div>
        @endif
    @endforeach

    <div class="research-meta d-flex align-items-center gap-3" style="margin-top: 8px; font-size: 12px; color: #107c70;">
        <span style="background: #eef2f8; color: #49658f; padding: 4px 9px; border-radius: 4px;">
            {{ $penelitian->tanggal }}
        </span>
        <span style="color: #777;">
            Tim Peneliti: {!! nl2br(e($penelitian->peneliti)) !!}
        </span>
    </div>

</div>

@endsection
