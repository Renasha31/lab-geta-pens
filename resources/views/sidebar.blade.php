@php
    $berita = \App\Models\Berita::latest()->take(5)->get();
@endphp

<div style="position: sticky; top: 20px;">
    <p class="mt-4" style="color: #3b4340; font-size: large;">Berita Terbaru</p>
    <hr>
    
    @foreach ($berita as $item)
        <p>
            <a href="{{ route('berita.show', $item->id) }}" style="text-decoration: none; color: #3b4340;">
                {{ $item->title }}
            </a>
        </p>
    @endforeach
</div>
