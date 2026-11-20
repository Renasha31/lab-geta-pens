@extends('layout.app')
@section('page-title', 'Penelitian')
@section('content')
    <h3 class="mt-4">
        Berdasarkan teknologi elektronika daya, kami melakukan penelitian berikut
        dengan tujuan mengembangkan peralatan yang sangat efisien dan ramah lingkungan:
    </h3>

    <div class="container mt-5 card" style="border: 1px solid #ccc; border-radius: 5px; padding: 15px;">
        <h3>Daftar Penelitian</h3>
        <hr>

        <div>
            @forelse ($penelitian as $p)
                <div class="card mb-3" style="border: 1px solid #ccc; border-radius: 10px;">
                    <div class="card-body">
                        <a href="{{ route('penelitian.show', $p->id) }}" class="text-decoration-none text-dark">
                            <h5 class="mb-0">{{ $p->judul }}</h5>
                        </a>
                    </div>
                </div>
            @empty
                <p>belum ada penelitian</p>
            @endforelse
        </div>
    </div>

@endsection
