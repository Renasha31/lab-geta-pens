@extends('layout.app')
@section('page-title', 'Info_GetaLab')
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

    <p class="mt-5" style="color: #E9B929; font-size: 27px;">{{ $terjemahkan('Perekrutan mahasiswa telah ditangguhkan.', 'info_rekrutmen') }}</p>
    <hr style="border-top: 3px solid #6BB5E8; opacity: 1;" class="mt-5">

    <h2 style="font-size: 27px;" class="mt-1">{{ $terjemahkan('Informasi laboratorium', 'info_judul') }} <strong style="color: #E9B929">({{ $terjemahkan('per April 2026', 'info_tanggal') }})</strong></h2>
    <hr style="color: #6BB5E8;">

    <h4 style="color: #619fc8;" class="mt-5 mb-4">{{ $terjemahkan('Afiliasi: Departemen Bioteknologi, Sekolah Pascasarjana Bioteknologi dan Rekayasa Sistem', 'info_afiliasi') }}</h4>
    <hr style="border-top: 3px solid #6BB5E8; opacity: 1;">

    <h3 style="color: #E9B929;" class="mb-4"><strong>{{ $terjemahkan('Personel laboratorium', 'info_personel') }}</strong></h3>
    <hr style="color: #E9B929">

    <p style="white-space: pre-line" class="mt-4">{{ $terjemahkan('Jumlah peserta: M2:5, D3:1 (1 orang dewasa yang bekerja)
Latar belakang: Institut Teknologi Kyushu, Departemen Teknik Elektro dan Elektronika; universitas lain; kursus lanjutan perguruan tinggi teknik lainnya; orang dewasa yang bekerja', 'info_jumlah_latar') }}</p>
    <hr style="border-top: 3px solid #6BB5E8; opacity: 1;">

    <h2 style="color: #E9B929; font-size: 27px;" class="mb-4"><strong>{{ $terjemahkan('Situasi pekerjaan (Gelar Magister)', 'info_pekerjaan') }}</strong></h2>
    <hr style="color: #E9B929">

    <p style="white-space: pre-line; line-height: 1.5;">{{ $terjemahkan('2013　TOTO, Honda Motor Co., Ltd., Toyota Motor Kyushu, Daikin Industries, Ltd., Ube Machinery Corporation
2014　Mitsubishi Electric x2, Toshiba, Fuji Electric Corporation
2015　Toyota Motor Kyushu, Hitachi, Ltd., Yaskawa Electric Corporation, Panasonic Corporation, Chugoku Electric Power Co., Ltd., Mitsubishi Hitachi Power Systems Co., Ltd.
2016　Mitsubishi Electric x2, Panasonic Eco Systems Co., Ltd., Fuji Electric Corporation, Ube Machinery Corporation, Yaskawa Electric Corporation, Aisin Comcruise Co., Ltd., Mitsubishi Motors Corporation
2017　Nippon Steel & Sumitomo Metal Corporation, Mitsubishi Motors Corporation, Sumitomo Wiring Systems Co., Ltd., Fuji Electric Corporation
2018　NEC, Asahi Kasei, Yaskawa Electric, JR West, NOK, Mitsubishi Electric, Nidec
2019　Asahi Glass, Asahi Kasei, Toyota, Honda, Toyota Motor Kyushu, Nippon Steel & Sumitomo Metal Engineering
2020　Nissan Motor, Yaskawa Electric, JR Central, Space Technology Development
2021　Suzuki, Yaskawa Electric, Aisin Seiki, Toyota Motor Kyushu, Fuji Electric, Fujitsu Client Computing
2021 (Oktober, Mahasiswa Internasional)　ULVAC (anak perusahaan China), Renesas Electronics
2022　Mitsubishi Chemical, OBIC, Kobe Steel
2024　Aisin, Nippon Steel, Lembaga Penelitian Jepang, Heili Marelli
2025　NTT Data, Kubota
2026　Yaskawa Electric, Fuji Electric, Honda, Totec Amenity', 'info_daftar_pekerjaan') }}</p>

    <h5 style="color: #E9B929;" class="mt-5">{{ $terjemahkan('Adegan eksperimental', 'info_adegan') }}</h5>

    <img src="{{ asset('images/WhatsApp Image 2026-11-23 at 8.20.35 AM (1).jpeg') }}" style="width: 100%; height: auto; object-fit: contain; display: block;" alt="">
@endsection

