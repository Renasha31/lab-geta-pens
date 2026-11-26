@php
    $berita = \App\Models\Berita::latest()->take(5)->get();
    $today = \Carbon\Carbon::now()->locale(app()->getLocale());
    $startDay = $today->copy()->startOfMonth()->dayOfWeekIso;
    $daysInMonth = $today->daysInMonth;

    $hari = [
        __('messages.Monday'),
        __('messages.Tuesday'),
        __('messages.Wednesday'),
        __('messages.Thursday'),
        __('messages.Friday'),
        __('messages.Saturday'),
        __('messages.Sunday'),
    ];
@endphp

<style>
    .sidebar-link {
        color: #555 !important;
        font-size: 16px;
        line-height: 1.7;
        text-decoration: none;
    }

    .sidebar-link:hover,
    .sidebar-link.active {
        color: #555 !important;
        text-decoration: underline;
    }
</style>

<div style="position: sticky; top: 20px;">
    <div style="margin-bottom: 15px;">

        <h4 style="font-size: 23px; font-weight: 400; color: #343a40; margin-bottom: 10px;">
            {{ __('messages.LatestNews') }}
        </h4>

        <div style="border-bottom: 1px solid #ddd;">
            <div style="width: 30%; border-bottom: 1px solid #4285c5;"></div>
        </div>

        @foreach ($berita as $item)
            @php
                $judul = $item->title;

                if (app()->getLocale() == 'en') {
                    $judul = \Illuminate\Support\Facades\Cache::remember(
                        'berita_sidebar_en_' . $item->id,
                        now()->addDays(30),
                        function () use ($item) {
                            try {
                                $translator = new \Stichoza\GoogleTranslate\GoogleTranslate('en');
                                return $translator->translate($item->title);
                            } catch (\Throwable $e) {
                                return $item->title;
                            }
                        },
                    );
                }
            @endphp

            <div style="padding: 12px 8px; border-bottom: 1px solid #eee;">
                <a href="{{ route('berita.show', $item->id) }}"
                    class="sidebar-link {{ request()->routeIs('berita.show') && request()->route('berita') == $item->id ? 'active' : '' }}">
                    {{ $judul }}
                </a>
            </div>
        @endforeach

    </div>

    {{-- KALENDER --}}

    <div>

        <h5 style="font-size: 20px; font-weight: 400; color: #495057; margin-bottom: 15px;">
            {{ $today->translatedFormat('F Y') }}
        </h5>

        <table style="width: 90%; max-width: 300px; margin: auto; border-collapse: collapse; table-layout: fixed;">

            <thead>
                <tr>
                    @foreach ($hari as $namaHari)
                        <th
                            style="background: #e5e5e5; border: 1px solid #ddd; padding: 6px 0; text-align: center; font-size: 11px; color: #343a40;">
                            {{ $namaHari }}
                        </th>
                    @endforeach
                </tr>
            </thead>

            <tbody>
                @php $day = 1; @endphp

                @while ($day <= $daysInMonth)
                    <tr>
                        @for ($col = 1; $col <= 7; $col++)
                            <td
                                style="border: 1px solid #ddd; height: 32px; text-align: center; font-size: 12px; color: #495057;">

                                @if (($day == 1 && $col < $startDay) || $day > $daysInMonth)
                                    &nbsp;
                                @else
                                    @if ($day == $today->day)
                                        <span
                                            style="display: inline-block; padding: 3px 6px; background: #367FB5; color: white; border-radius: 50%; font-weight: bold;">
                                            {{ $day }}
                                        </span>
                                    @else
                                        <span style="display: inline-block; padding: 3px 6px;">
                                            {{ $day }}
                                        </span>
                                    @endif

                                    @php $day++; @endphp
                                @endif

                            </td>
                        @endfor
                    </tr>
                @endwhile
            </tbody>

        </table>

    </div>
</div>
