@php
    $berita = \App\Models\Berita::latest()->take(5)->get();
@endphp

<h4 class="mt-3">Berita Terbaru</h4>
<hr>

@foreach ($berita as $item)
    <p style="">
        <a href="{{ route('berita.show', $item->id) }}">
            {{ $item->title }}
        </a>
    </p> 
    
    <h1>nyoba uy</h1>
@endforeach
