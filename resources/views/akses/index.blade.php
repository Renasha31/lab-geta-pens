@extends('layout.app')
@section('page-title', 'Akses')
@section('content')

    <p style="white-space: pre-line;">
        Alamat: Jl. Raya ITS, Keputih, Kec. Sukolilo, Kota Surabaya, Jawa Timur 60111
        Telepon: (031) 5947280
        Fax: (031) 5946114
        Email: pens@pens.ac.id
        Website Resmi: Politeknik Elektronika Negeri Surabaya
    </p>

    <div class="maps-section">
        <iframe src="https://maps.google.com/maps?q=Politeknik%20Elektronika%20Negeri%20Surabaya&output=embed" width="50%"
            height="580" style="border: 0;" allowfullscreen="0" loading="lazy">
        </iframe>
    </div>

@endsection
