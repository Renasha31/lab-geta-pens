```php
@extends('layout.app')
@section('page-title', 'Akses')
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

    <p style="white-space: pre-line;">
        {{ $terjemahkan('Alamat:', 'akses_alamat') }} {{ $terjemahkan('Jl. Raya ITS, Keputih, Kec. Sukolilo, Kota Surabaya, Jawa Timur 60111', 'akses_lokasi') }}
        {{ $terjemahkan('Telepon:', 'akses_telepon') }} (031) 5947280
        {{ $terjemahkan('Fax:', 'akses_fax') }} (031) 5946114
        {{ $terjemahkan('Email:', 'akses_email') }} pens@pens.ac.id
        {{ $terjemahkan('Website Resmi:', 'akses_website') }} {{ $terjemahkan('Politeknik Elektronika Negeri Surabaya', 'akses_nama_website') }}
    </p>

    <div class="maps-section">
        <iframe src="https://maps.google.com/maps?q=Politeknik%20Elektronika%20Negeri%20Surabaya&output=embed" width="80%"
            height="580"; style="border: 0;" allowfullscreen="0" loading="lazy">
        </iframe>
    </div>

@endsection
```
