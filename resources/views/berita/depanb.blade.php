@extends('layout.app')
@section('page-title', 'Berita')
@section('content')

    <div class="container mt-5">
        <h3>Daftar Berita : </h3>
        <hr>

        <ol>
            @forelse ($berita as $b)
                <p>
                    <li style="font-size: 150%">
                        <a href="{{ route('berita.show', $b->id) }}" style="text-decoration: none"> {{ $b->title }} </a>
                    </li>
                </p>
            @empty
                <p>belum ada berita</p>
            @endforelse
        </ol>
    </div>

@endsection
