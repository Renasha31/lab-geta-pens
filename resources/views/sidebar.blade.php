@php
    $berita = \App\Models\Berita::latest()->take(5)->get();
@endphp

<h4 class="mt-3">Berita Terbaru</h4>
<hr>

@foreach ($berita as $item)
    <p style="color: black;">
        <a href="{{ route('berita.show', $item->id) }}" style="text-decoration: none">
            {{ $item->title }}
        </a>
    </p>
@endforeach
