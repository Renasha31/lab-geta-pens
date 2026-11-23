
@php
    $berita = \App\Models\Berita::latest()->take(5)->get();

    $today = \Carbon\Carbon::now();
    $month = $today->copy()->startOfMonth();
    $startDay = $month->dayOfWeekIso;
    $daysInMonth = $today->daysInMonth;
@endphp

<style>
    .sidebar-wrapper {
        position: sticky;
        top: 20px;
    }

    .sidebar-calendar {
        margin-top: 30px;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 2px 8px #eee;
        background: white;
        width: 100%;
    }

    .sidebar-calendar table {
        width: 100%;
        table-layout: fixed;
        border-collapse: collapse;
        margin-top: 15px;
    }

    .sidebar-calendar th,
    .sidebar-calendar td {
        border: 1px solid #ddd;
        text-align: center;
        font-size: 13px;
        height: 38px;
    }

    .sidebar-calendar th {
        background: #f1f1f1;
        font-weight: bold;
    }

    .sidebar-calendar .today {
        background: #3b4340;
        color: white;
        border-radius: 50%;
        font-weight: bold;
    }
</style>

<div class="sidebar-wrapper">

    <p class="mt-4" style="color: #3b4340; font-size: large;">
        Berita Terbaru
    </p>
    <hr>

    @foreach ($berita as $item)
        <p>
            <a href="{{ route('berita.show', $item->id) }}"
                style="text-decoration: none; color: #3b4340;">
                {{ $item->title }}
            </a>
        </p>
    @endforeach

    <div class="sidebar-calendar">

        <h5 class="text-center">
            {{ $today->translatedFormat('F Y') }}
        </h5>

        <table>
            <thead>
                <tr>
                    <th>Sen</th>
                    <th>Sel</th>
                    <th>Rab</th>
                    <th>Kam</th>
                    <th>Jum</th>
                    <th>Sab</th>
                    <th>Min</th>
                </tr>
            </thead>

            <tbody>
                @php $day = 1; @endphp

                @while ($day <= $daysInMonth)
                    <tr>
                        @for ($col = 1; $col <= 7; $col++)
                            <td>
                                @if (($day == 1 && $col < $startDay) || $day > $daysInMonth)
                                    &nbsp;
                                @else
                                    <span class="{{ $day == $today->day ? 'today' : '' }}"
                                        style="display:inline-block; padding:5px 8px;">
                                        {{ $day }}
                                    </span>
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
