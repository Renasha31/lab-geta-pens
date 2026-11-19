@extends('layout.app')
@section('page-title', 'Anggota')
@section('content')

    <style>
        .anggota-utama img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 5px;
        }

        .anggota-item {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .anggota-item img {
            width: 110px;
            height: 110px;
            object-fit: cover;
            border-radius: 10px;
        }

        .anggota-item p {
            margin-bottom: 5px;
            font-size: 14px;
        }

        @media(max-width: 768px) {
            .anggota-item img {
                width: 90px;
                height: 90px;
            }
        }
    </style>

    <div class="container mt-2">

        <h2 class="fw-bold mb-3">Daftar Anggota</h2>

        <div class="row g-4">
            <div class="col-md-6">

                @php
                    $utama = $anggota->firstWhere('jenis_anggota', 'Profesor') ?? $anggota->first();
                @endphp

                @if ($utama)
                    <div class="anggota-utama">

                        <img src="{{ url('storage/' . $utama->image) }}" alt="Foto Anggota">

                        <h4 class="fw-bold mt-3">{{ $utama->nama_anggota }}</h4>

                        <p>{{ $utama->jenis_anggota }}</p>
                        <p>{{ $utama->ttl }}</p>

                        <p style="white-space: pre-line;">
                            {{ $utama->rpdk }}
                        </p>

                    </div>
                @endif

            </div>
            {{-- Search dan anggota lainnya --}}
            <div class="col-md-6">

                <input type="text" id="cari" class="form-control mb-4" placeholder="Cari anggota...">

                @foreach ($anggota as $a)
                    @if (!$utama || $a->id != $utama->id)
                        <div class="anggota-item">

                            <img src="{{ url('storage/' . $a->image) }}" alt="Foto Anggota">

                            <div>
                                <h6 class="fw-bold mb-1">{{ $a->nama_anggota }}</h6>

                                <p>{{ $a->jenis_anggota }}</p>
                                <p>{{ $a->ttl }}</p>

                                <p>{{ Str::limit($a->rpdk, 80) }}</p>
                            </div>

                        </div>
                    @endif
                @endforeach

                <p id="kosong" style="display:none;">
                    Anggota tidak ditemukan.
                </p>

            </div>


        </div>
    </div>

    <script>
    document.getElementById('cari').addEventListener('input', function() {
        let cari = this.value.toLowerCase().trim();
        let anggota = document.querySelectorAll('.anggota-item');
        let jumlah = 0;

        anggota.forEach(function(item) {
            let nama = item.querySelector('h6').innerText.toLowerCase();
            let jenis = item.querySelector('p:nth-of-type(1)').innerText.toLowerCase();
            let ttl = item.querySelector('p:nth-of-type(2)').innerText.toLowerCase();
            let riwayat = item.querySelector('p:nth-of-type(3)').innerText.toLowerCase();

            if (
                nama.includes(cari) ||
                jenis.includes(cari) ||
                ttl.includes(cari) ||
                riwayat.includes(cari)
            ) {
                item.style.display = 'flex';
                jumlah++;
            } else {
                item.style.display = 'none';
            }
        });

        document.getElementById('kosong').style.display =
            jumlah === 0 ? 'block' : 'none';
    });
</script>

@endsection
