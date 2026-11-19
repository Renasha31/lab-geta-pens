@extends('layout.app')
@section('title', 'Detail Anggota')
@section('content')
    <style>
        .research-detail h1 {
            font-size: 40px;
            font-weight: 400;
            margin-bottom: 20px;
        }

        .research-detail p {
            font-size: 15px;
            margin-bottom: 25px;
        }

        .research-detail h5 {
            font-size: 18px;
            font-weight: 400;
            line-height: 1.8;
            color: #333;
            white-space: pre-line;
        }

        .research-detail h2 {
            font-size: 27px;
            font-weight: 500;
            line-height: 1.5;
            margin-bottom: 25px;
        }

        .research-content {
            font-size: 18px;
            line-height: 1.9;
            color: #444;
            text-align: justify;
        }

        .research-meta {
            margin-top: 25px;
            font-size: 13px;
            color: #777;
            line-height: 1.8;
        }

        .research-image {
            text-align: center;
            margin-bottom: 25px;
        }

        .research-image img {
            max-width: 100%;
            height: 300px;
            object-fit: contain;
        }
    </style>

    <div class="research-detail">
        <h1>{{ $anggota->nama_anggota }}</h1>
        <div class="research-image">
            <img src="{{ url('storage/' . $anggota->image) }}" alt="">
        </div>
        <h1 class="text-center">{{ $anggota->jenis_anggota }}</h1>
        <p>{{ $anggota->ttl }}</p>
        <h5>{{ $anggota->rpdk }}</h5>
    </div>
@endsection
