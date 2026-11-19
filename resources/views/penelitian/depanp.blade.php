@extends('layout.app')
@section('page-title', 'Penelitian')
@section('content')
    <h3 class="mt-4">
        Berdasarkan teknologi elektronika daya, kami melakukan penelitian berikut
        dengan tujuan mengembangkan peralatan yang sangat efisien dan ramah lingkungan:
    </h3>

    <div class="container mt-5">
        <h3>Daftar Penelitian</h3>
        <ol>
            @forelse ($penelitian as $p)
                <p>
                    <li style="font-size: 150%">
                        <a href="{{ route('penelitian.show', $p->id) }}"> {{ $p->judul }} </a>
                    </li>
                </p>
            @empty
                <h5>Belum ada penelitian.</h5>
            @endforelse
        </ol>
    </div>

@endsection
