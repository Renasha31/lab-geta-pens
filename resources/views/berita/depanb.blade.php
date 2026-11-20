@extends('layout.app')
@section('page-title', 'Berita')
@section('content')
    <h3 class="mt-4">
        Kami menghadirkan berbagai berita dan informasi mengenai kegiatan laboratorium,
        hasil penelitian, kerja sama, serta inovasi teknologi yang dikembangkan oleh Laboratorium GETA.
    </h3>

    <div class="container mt-5">
        <h3>Berita Terkini: </h3>
        <ol>
            @forelse ($berita as $b)
                <p>
                    <li style="font-size: 150%">
                        <a href="{{ route('berita.show', $b->id) }}" style="text-decoration: none"> {{ $b->title }} </a>
                    </li>
                </p>
            @empty
                <h5>Belum ada berita.</h5>
            @endforelse
        </ol>
    </div>

@endsection
