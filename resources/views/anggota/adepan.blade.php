
@extends('layout.app')
@section('page-title', 'Anggota')
@section('content')

<style>
    .anggota-section {
        padding: 20px 0 40px;
    }

    .judul-halaman {
        font-size: 28px;
        font-weight: 700;
        color: #263b32;
        margin-bottom: 5px;
    }

    .subjudul {
        color: #858f89;
        font-size: 14px;
        margin-bottom: 28px;
    }

    /* Anggota utama */
    .anggota-utama {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.07);
        border: 1px solid #edf0ed;
        height: 100%;
    }

    .anggota-utama img {
        width: 100%;
        height: 350px;
        object-fit: cover;
        display: block;
    }

    .utama-info {
        padding: 22px;
    }

    .utama-info h4 {
        font-weight: 700;
        color: #263b32;
        margin-bottom: 8px;
    }

    .badge-anggota {
        display: inline-block;
        background: #e8f0e9;
        color: #456b4d;
        padding: 6px 13px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 12px;
    }

    .utama-info p {
        color: #68736c;
        font-size: 14px;
        line-height: 1.7;
    }

    /* Tombol detail */
    .btn-detail {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 11px;
        background: #456b4d;
        color: white;
        text-decoration: none;
        font-size: 11px;
        font-weight: 600;
        border-radius: 6px;
        transition: 0.3s;
    }

    .btn-detail:hover {
        background: #2f5037;
        color: white;
        transform: translateY(-2px);
    }

    /* Search */
    .search-box {
        position: relative;
        margin-bottom: 20px;
    }

    .search-box input {
        border: 1px solid #e2e8e3;
        border-radius: 12px;
        padding: 13px 16px;
        font-size: 14px;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.03);
    }

    .search-box input:focus {
        border-color: #66866a;
        box-shadow: 0 0 0 3px rgba(102, 134, 106, 0.12);
    }

    .judul-list {
        font-size: 18px;
        font-weight: 700;
        color: #263b32;
        margin-bottom: 17px;
    }

    /* Card anggota lainnya */
    .anggota-item {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        padding: 15px;
        background: #fff;
        border: 1px solid #edf0ed;
        border-radius: 13px;
        margin-bottom: 14px;
        transition: 0.25s ease;
    }

    .anggota-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.07);
        border-color: #d6e2d7;
    }

    .anggota-item img {
        width: 105px;
        height: 105px;
        object-fit: cover;
        border-radius: 10px;
        flex-shrink: 0;
    }

    .anggota-info {
        min-width: 0;
        flex: 1;
    }

    .anggota-info h6 {
        color: #263b32;
        font-size: 15px;
        font-weight: 700;
        margin-bottom: 7px;
    }

    .anggota-info p {
        color: #778078;
        font-size: 13px;
        line-height: 1.6;
        margin-bottom: 4px;
    }

    .anggota-info .jenis {
        color: #557b5b;
        font-weight: 600;
    }

    #kosong {
        text-align: center;
        padding: 25px;
        color: #89958b;
        background: #fff;
        border-radius: 12px;
        border: 1px dashed #dce5dd;
    }

    /* Tampilan ketika belum ada data */
    .data-kosong {
        text-align: center;
        padding: 45px 20px;
        background: #fff;
        border: 1px dashed #dce5dd;
        border-radius: 14px;
        color: #89958b;
    }

    .data-kosong i {
        font-size: 35px;
        color: #78927c;
        display: block;
        margin-bottom: 12px;
    }

    .data-kosong h5 {
        color: #456b4d;
        font-weight: 700;
        font-size: 17px;
    }

    .data-kosong p {
        font-size: 13px;
        margin-bottom: 0;
    }

    @media(max-width: 768px) {
        .judul-halaman {
            font-size: 23px;
        }

        .anggota-utama img {
            height: 280px;
        }

        .anggota-item img {
            width: 85px;
            height: 85px;
        }

        .anggota-item {
            gap: 12px;
            padding: 12px;
        }
    }
</style>

<div class="container anggota-section">

    <h2 class="judul-halaman">Daftar Anggota</h2>

    <p class="subjudul">
        Kenali anggota yang tergabung dalam tim penelitian kami.
    </p>

    @php
        $utama = $anggota->firstWhere('jenis_anggota', 'Profesor') ?? $anggota->first();

        $lainnya = $anggota->filter(function ($a) use ($utama) {
            return !$utama || $a->id != $utama->id;
        });
    @endphp

    @if (!$utama)

        {{-- Jika belum ada data anggota --}}
        <div class="data-kosong">
            <i class="bi bi-people"></i>
            <h5>Belum Ada Data Anggota</h5>
            <p>Data anggota belum tersedia saat ini.</p>
        </div>

    @else

        <div class="row g-4">

            {{-- Anggota utama --}}
            <div class="col-lg-5">

                <div class="anggota-utama">

                    <img src="{{ url('storage/' . $utama->image) }}"
                        alt="Foto {{ $utama->nama_anggota }}">

                    <div class="utama-info">

                        <span class="badge-anggota">
                            {{ $utama->jenis_anggota }}
                        </span>

                        <h4>{{ $utama->nama_anggota }}</h4>

                        <p>{{ $utama->ttl }}</p>

                        <hr style="border-color: #edf0ed;">

                        <p style="white-space: pre-line;">
                            {{ Str::limit($utama->rpdk, 150) }}
                        </p>

                        <div class="text-end mt-2">
                            <a href="{{ route('anggota.show', $utama->id) }}"
                                class="btn-detail">
                                Lihat Selengkapnya
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>

                    </div>
                </div>

            </div>

            {{-- Anggota lainnya --}}
            <div class="col-lg-7">

                @if ($lainnya->isNotEmpty())

                    <h5 class="judul-list">Anggota Lainnya</h5>

                    <div class="search-box">
                        <input type="text" id="cari" class="form-control"
                            placeholder="Cari nama, jabatan, atau informasi anggota...">
                    </div>

                    <div id="daftar-anggota">

                        @foreach ($lainnya as $a)

                            <div class="anggota-item">

                                <img src="{{ url('storage/' . $a->image) }}"
                                    alt="Foto {{ $a->nama_anggota }}">

                                <div class="anggota-info">

                                    <h6>{{ $a->nama_anggota }}</h6>

                                    <p class="jenis">
                                        {{ $a->jenis_anggota }}
                                    </p>

                                    <p>{{ $a->ttl }}</p>

                                    <p>
                                        {{ Str::limit($a->rpdk, 80) }}
                                    </p>

                                    <div class="text-end mt-2">
                                        <a href="{{ route('anggota.show', $a->id) }}"
                                            class="btn-detail">
                                            Lihat Selengkapnya
                                            <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>

                                </div>
                            </div>

                        @endforeach

                    </div>

                    <p id="kosong" style="display:none;">
                        <i class="bi bi-person-x fs-4 d-block mb-2"></i>
                        Anggota tidak ditemukan.
                    </p>

                @else

                    {{-- Jika hanya ada satu anggota --}}
                    <div class="data-kosong">
                        <i class="bi bi-people"></i>
                        <h5>Belum Ada Anggota Lainnya</h5>
                        <p>Anggota lainnya akan ditampilkan di sini.</p>
                    </div>

                @endif

            </div>

        </div>

    @endif

</div>

<script>
    const inputCari = document.getElementById('cari');

    if (inputCari) {
        inputCari.addEventListener('input', function() {

            let cari = this.value.toLowerCase().trim();
            let anggota = document.querySelectorAll('.anggota-item');
            let jumlah = 0;

            anggota.forEach(function(item) {

                let teks = item.innerText.toLowerCase();

                if (teks.includes(cari)) {
                    item.style.display = 'flex';
                    jumlah++;
                } else {
                    item.style.display = 'none';
                }

            });

            const pesanKosong = document.getElementById('kosong');

            if (pesanKosong) {
                pesanKosong.style.display =
                    jumlah === 0 ? 'block' : 'none';
            }

        });
    }
</script>

@endsection
