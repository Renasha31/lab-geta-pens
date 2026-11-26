
@extends('layout.app')
@section('page-title', app()->getLocale() == 'en' ? 'Researches' : 'Penelitian')
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

    $intro = $terjemahkan(
        'Berdasarkan teknologi elektronika daya, kami melakukan berbagai penelitian untuk mengembangkan peralatan yang efisien dan ramah lingkungan.',
        'penelitian_intro_en'
    );

    $subIntro = $terjemahkan(
        'Eksplorasi inovasi dan pengembangan teknologi untuk masa depan.',
        'penelitian_subintro_en'
    );

    $judulDaftar = $terjemahkan('Daftar Penelitian', 'penelitian_daftar_en');
    $subJudul = $terjemahkan('Kumpulan penelitian yang telah dilakukan', 'penelitian_kumpulan_en');
    $kosong = $terjemahkan('Belum Ada Penelitian', 'penelitian_kosong_en');
    $pesanKosong = $terjemahkan('Data penelitian belum tersedia saat ini.', 'penelitian_pesan_kosong_en');
@endphp

<style>
    .penelitian-section {
        padding: 35px 0 50px;
    }

    .penelitian-intro {
        background: linear-gradient(135deg, #367FB5, #0a579f);
        border-radius: 14px;
        padding: 35px;
        color: white;
        margin-bottom: 35px;
    }

    .penelitian-intro h3 {
        font-size: 23px;
        font-weight: 600;
        line-height: 1.6;
        margin: 0;
        max-width: 850px;
    }

    .penelitian-intro p {
        font-size: 14px;
        margin: 12px 0 0;
        color: #e5f2fa;
    }

    .penelitian-container {
        background: #fff;
        border: 1px solid #e2eaf0;
        border-radius: 14px;
        padding: 28px;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.04);
    }

    .penelitian-heading {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 22px;
    }

    .penelitian-icon {
        width: 43px;
        height: 43px;
        background: #e8f2f8;
        color: #28658f;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 21px;
    }

    .penelitian-heading h4 {
        color: #28658f;
        font-weight: 700;
        margin: 0;
        font-size: 21px;
    }

    .penelitian-heading p {
        color: #888;
        font-size: 13px;
        margin: 3px 0 0;
    }

    .penelitian-card {
        border: 1px solid #e2eaf0;
        border-radius: 10px;
        margin-bottom: 13px;
        transition: all .25s ease;
        overflow: hidden;
    }

    .penelitian-card:last-child {
        margin-bottom: 0;
    }

    .penelitian-card:hover {
        border-color: #28658f;
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(51, 127, 178, 0.10);
    }

    .penelitian-link {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 19px 21px;
        text-decoration: none;
        color: #28658f;
    }

    .penelitian-link h5 {
        font-size: 16px;
        font-weight: 600;
        margin: 0;
        line-height: 1.5;
    }

    .penelitian-arrow {
        color: #28658f;
        font-size: 19px;
        transition: transform .25s ease;
        flex-shrink: 0;
    }

    .penelitian-card:hover .penelitian-arrow {
        transform: translateX(5px);
    }

    .penelitian-empty {
        text-align: center;
        padding: 45px 20px;
        background: #f6f9fc;
        border-radius: 10px;
        border: 1px dashed #b9d2e3;
    }

    .penelitian-empty i {
        font-size: 38px;
        color: #28658f;
    }

    .penelitian-empty h5 {
        color: #28658f;
        font-weight: 600;
        margin-top: 12px;
    }

    .penelitian-empty p {
        color: #888;
        font-size: 14px;
        margin-bottom: 0;
    }

    @media (max-width: 576px) {
        .penelitian-intro {
            padding: 25px 20px;
        }

        .penelitian-intro h3 {
            font-size: 19px;
        }

        .penelitian-container {
            padding: 20px 15px;
        }

        .penelitian-link {
            padding: 16px;
        }

        .penelitian-link h5 {
            font-size: 14px;
        }
    }
</style>

<div class="container penelitian-section">

    <div class="penelitian-intro">
        <h3>{{ $intro }}</h3>
        <p>{{ $subIntro }}</p>
    </div>

    <div class="penelitian-container">

        <div class="penelitian-heading">
            <div class="penelitian-icon">
                <i class="bi bi-journal-text"></i>
            </div>
            <div>
                <h4>{{ $judulDaftar }}</h4>
                <p>{{ $subJudul }}</p>
            </div>
        </div>

        @forelse ($penelitian as $p)
            @php
                $judul = $terjemahkan(
                    $p->judul,
                    'penelitian_depanp_judul_en_' . $p->id . '_' . $p->updated_at->timestamp
                );
            @endphp

            <div class="penelitian-card">
                <a href="{{ route('penelitian.show', $p->id) }}"
                    class="penelitian-link">

                    <h5>{{ $judul }}</h5>

                    <i class="bi bi-arrow-right-circle penelitian-arrow"></i>
                </a>
            </div>
        @empty
            <div class="penelitian-empty">
                <i class="bi bi-journal-x"></i>
                <h5>{{ $kosong }}</h5>
                <p>{{ $pesanKosong }}</p>
            </div>
        @endforelse

        @if ($penelitian->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $penelitian->links() }}
            </div>
        @endif

    </div>
</div>

@endsection
