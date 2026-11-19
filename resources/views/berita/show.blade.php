@extends('layout.app')
@section('title', 'Detail Berita')
@section('content')
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

        .research-image {
            text-align: center;
            margin-bottom: 25px;
        }

        .research-image img {
            max-width: 100%;
            height: 300px;
            object-fit: contain;
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
    </style>

        <div class="research-detail">
            <h2>{{ $berita->title }}</h2>
            <div class="research-image">
                <img src="{{ url('storage/' . $berita->gambar) }}" alt="{{ $berita->title }}">
            </div>
            <div class="research-content">
                {!! nl2br(e($berita->konten)) !!}
            </div>
            <div class="research-meta">
                <div>{{ $berita->tgl }}</div>
            </div>
        </div>
@endsection
