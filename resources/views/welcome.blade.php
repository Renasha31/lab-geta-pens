@extends('layout.app')
@section('title', 'welcome')
@section('top-content')
    <style>
        .research-detail {
            font-family: 'Arial', sans-serif;
            /* Ganti font di sini */
        }

        #carouselExampleIndicators {
            width: 100%;
            margin: 0;
        }

        #carouselExampleIndicators .carousel-item img {
            width: 100%;
            height: 32vw;
            min-height: 350px;
            max-height: 520px;
            object-fit: cover;
            object-position: center;
        }
    </style>

    <div id="carouselExampleIndicators" class="carousel slide mt-4" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://i.pinimg.com/1200x/bd/90/87/bd908749d8af201c2d7b6cd21c401143.jpg" class="d-block w-100"
                    alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://i.pinimg.com/736x/16/82/19/16821954abc9197ce94f7587d17da9c0.jpg" class="d-block w-100"
                    alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://i.pinimg.com/1200x/be/a2/d5/bea2d5bb3ef3ac9e26bbc1569a2744c9.jpg" class="d-block w-100"
                    alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

@endsection
@section('content')

    <h2 class="mt-4">Selamat datang di Laboratorium Green Energy, Transpotation, And Application.</h2>
    <hr>
    <p>Kami melakukan konversi daya dan kontrol motor menggunakan elektronika daya.</p>
    <br>
    <p style="text-align: justify; line-height: 1.8;" class="mb-5">15 Juli 2026: Buletin Meisen No. 944
        diterbitkan 15 Juli 2026: Buletin Meisen No. 943 diterbitkan 15 Mei 2026: Buletin Meisen No. 942 diterbitkan 7 April
        2026: Upacara Penerimaan Mahasiswa Baru Tahun Akademik 2026
        25 Maret 2026 : Upacara Wisuda Tahun Akademik 2025 17 Februari 2026: Presentasi Tesis Kelulusan Tahun Akademik 2025
        19 Februari 2026: Presentasi Tesis Magister Tahun Akademik 2025</p>

    <p class="mb-5">Tahun 2026</p>

    <p>25 September 2025 Upacara Wisuda September
        2025 15 September 2025 Penerbitan Buletin Meisen No. 938 15 Juli
        2025 Penerbitan Buletin Meisen No. 937 3 April 2025 Upacara Penerimaan Mahasiswa Baru 25 Maret 2025 Upacara Wisuda
        2024
        20 Februari 2025 Presentasi Skripsi Sarjana 17 Februari 2025 Presentasi Tesis Magister 15 Januari 2025 Penerbitan
        Buletin Meisen No. 934</p>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
