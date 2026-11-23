
@php
    $berita = \App\Models\Berita::latest()->take(5)->get();
    $today = \Carbon\Carbon::now();
    $startDay = $today->copy()->startOfMonth()->dayOfWeekIso;
    $daysInMonth = $today->daysInMonth;
@endphp

<div style="position: sticky; top: 20px;">
    <div style="margin-bottom: 45px;">

        <h4 style="font-size: 23px; font-weight: 400; color: #343a40; margin-bottom: 10px;">Berita Terbaru</h4>

        <div style="border-bottom: 1px solid #ddd;">
            <div style="width: 30%; border-bottom: 1px solid #4285c5;"></div>
        </div>

        @foreach ($berita as $item)
            <div style="padding: 12px 8px; border-bottom: 1px solid #eee;">
                <a href="{{ route('berita.show', $item->id) }}"
                    style="text-decoration: none; color: #555; font-size: 16px; line-height: 1.7;">
                    {{ $item->title }}
                </a>
            </div>
        @endforeach

    </div>

    {{-- KALENDER --}}
    <div>

        <h5 style="font-size: 20px; font-weight: 400; color: #495057; margin-bottom: 18px;">
            {{ $today->translatedFormat('F Y') }}
        </h5>

        <table style="width: 100%; border-collapse: collapse; table-layout: fixed;">

            <thead>
                <tr>
                    @foreach (['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'] as $hari)
                        <th style="background: #e5e5e5; border: 1px solid #ddd; padding: 9px 0; text-align: center; font-size: 13px; color: #343a40;">
                            {{ $hari }}
                        </th>
                    @endforeach
                </tr>
            </thead>

            <tbody>
                @php $day = 1; @endphp

                @while ($day <= $daysInMonth)
                    <tr>
                        @for ($col = 1; $col <= 7; $col++)
                            <td style="border: 1px solid #ddd; height: 42px; text-align: center; font-size: 14px; color: #495057;">

                                @if (($day == 1 && $col < $startDay) || $day > $daysInMonth)
                                    &nbsp;
                                @else
                                    @if ($day == $today->day)
                                    <span style="display: inline-block; padding: 5px 8px; background: #3b4340; color: white; border-radius: 50%; font-weight: bold;">
                                        {{ $day }}
                                    </span>
                                @else
                                     <span style="display: inline-block; padding: 5px 8px;">
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
