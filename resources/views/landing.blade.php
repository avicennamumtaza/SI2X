@extends('layouts.app')

@section('content')
    <div id="beranda" class="container container-landing col-10">
        <div class="row custom-section">
            <div class="col-12 col-lg-5">
                <h2>Selamat Datang</h2>
                <h6>
                    <b>Kemudahan Layanan dalam Jangkauan!</b>
                </h6>
                {{-- <div class="col-12 col-lg-10"> --}}
                <p>Menghadirkan inovasi digital yang solutif untuk memudahkan pelayanan, pengelolaan, dan transparansi dalam
                    lingkungan
                    Rukun Warga. Pelayanan yang efektif dan efisien bagi anda adalah prioritas bagi kami. Klik tombol
                    selengkapnya untuk melihat
                    layanan kami.</p>
                {{-- </div> --}}
                <a href="#layanan" id="selengkapnya-btn" title="Selengkapnya">Selengkapnya</a>
            </div>
        </div>
    </div>
    <img src="{{ asset('assets/landing-pict.png') }}" alt="background" class="main-image">
    <div id="stats" class="container container-statsngal col-10 pt-5">
        <h1 class="heading-center pt-5 text-center">Statistik</h1>
        <div class="row justify-content-center">
            <div class="col-md-2 col-sm-4 col-12 mb-4">
                <div class="card">
                    <i class="bi bi-person-check card-icon"></i>
                    <span class="span-count">{{ $data['jumlah_penduduk'] }}</span>
                    <span class="span-head">Penduduk Terdata</span>
                </div>
            </div>
            <div class="col-md-2 col-sm-4 col-12 mb-4">
                <div class="card">
                    <i class="bi bi-house-door card-icon"></i>
                    <span class="span-count">{{ $data['jumlah_keluarga'] }}</span>
                    <span class="span-head">Keluarga Terdata</span>
                </div>
            </div>
            <div class="col-md-2 col-sm-4 col-12 mb-4">
                <div class="card">
                    <i class="bi bi-person-badge card-icon"></i>
                    <span class="span-count">{{ $data['jumlah_rt'] }}</span>
                    <span class="span-head">Rukun Tetangga</span>
                </div>
            </div>
            <div class="col-md-2 col-sm-4 col-12 mb-4">
                <div class="card">
                    <i class="bi bi-megaphone card-icon"></i>
                    <span class="span-count">{{ $data['jumlah_pengumuman'] }}</span>
                    <span class="span-head">Pengumuman Diterbitkan</span>
                </div>
            </div>
            <div class="col-md-2 col-sm-4 col-12 mb-4">
                <div class="card">
                    <i class="bi bi-shop-window card-icon"></i>
                    <span class="span-count">{{ $data['jumlah_umkm'] }}</span>
                    <span class="span-head">UMKM Terdaftar</span>
                </div>
            </div>
            <div class="col-md-2 col-sm-4 col-12 mb-4">
                <div class="card">
                    <i class="bi bi-file-earmark-pdf card-icon"></i>
                    <span class="span-count">{{ $data['jumlah_pengajuan_dokumen'] }}</span>
                    <span class="span-head">Dokumen Diproses</span>
                </div>
            </div>
        </div>
    </div>

    @if ($pengumuman2 != null)
        <div id="pengumuman" class="container container-pengumuman col-10">
            <h1 class="heading-center pt-5">Pengumuman Terbaru</h1>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="card col-md-5 p-0 m-4 rounded">
                        <img class="img-fluid rounded-bottom pengimg"
                        src="{{ $pengumuman1['foto_pengumuman'] ? asset('storage/' . $pengumuman1['foto_pengumuman']) : 'https://img.freepik.com/free-photo/stylish-asian-girl-making-announcement-megaphone-shouting-with-speakerphone-smiling-inviting-people-recruiting-standing-blue-background_1258-89437.jpg?w=900' }}"
                        alt="Foto Pengumuman{{ $pengumuman1['foto_pengumuman'] }}">
                        <div class="card-body">
                            <h5 class="mt-3">{{ $pengumuman1['judul'] }}</h5>
                            <p class="">{{ $pengumuman1['deskripsi'] }}</p>
                            <p class="">
                                <small class="">
                                    {{ \Carbon\Carbon::parse($pengumuman1['tanggal'])->translatedFormat('d F Y') }}
                                </small>
                            </p>
                        </div>
                    </div>
                    <div class="card col-md-5 p-0 m-4 rounded">
                        <img class="img-fluid rounded-bottom pengimg"
                        src="{{ $pengumuman2['foto_pengumuman'] ? asset('storage/' . $pengumuman2['foto_pengumuman']) : 'https://img.freepik.com/free-photo/stylish-asian-girl-making-announcement-megaphone-shouting-with-speakerphone-smiling-inviting-people-recruiting-standing-blue-background_1258-89437.jpg?w=900' }}"
                            alt="Foto Pengumuman{{ $pengumuman2['foto_pengumuman'] }}">
                        <div class="card-body">
                            <h5 class="mt-3">{{ $pengumuman2['judul'] }}</h5>
                            <p class="">{{ $pengumuman2['deskripsi'] }}</p>
                            <p class="">
                                <small class="">
                                    {{ \Carbon\Carbon::parse($pengumuman2['tanggal'])->translatedFormat('d F Y') }}
                                </small>
                            </p>
                        </div>
                    </div>
                </div>
                <a class="position-absolute start-50 translate-middle-x" href="{{ route('pengumuman.global') }}"
                    title="Pengumuman lainnya">Lainnya</a>
            </div>
        </div>
    @endif
    <div id="" class="container container-rtrw col-10">
        <h1 class="heading-center mb-0">Administrator</h1>
        <div class='row wrapper' style="margin-top: 11rem">
            <div class='carousel'>
                <?php $counter = 16; ?>
                @foreach ($fotoUsers as $index => $fotoUser)
                    <?php $counter--; ?>
                    <div class='carousel__item'>
                        <div class='carousel__item-head'>
                            <img class="profile-picture rounded-circle"
                                src="{{ $fotoUsers[$index] ? asset('Foto Users/' . $fotoUsers[$index]) : 'https://img.freepik.com/free-photo/stylish-asian-girl-making-announcement-megaphone-shouting-with-speakerphone-smiling-inviting-people-recruiting-standing-blue-background_1258-89437.jpg?w=900' }}"
                                alt="Foto User{{ $fotoUsers[$index] }}"
                                style="width: 85px; height: 85px; object-fit: cover;">
                        </div>
                        <div class='carousel__item-body'>
                            <p class='title'>{{ str_replace(['[', ']', '"'], '', $namaUsers[$index]) }}</p>
                            @if (str_replace(['[', ']', '"'], '', $titleUsers[$index]) == 'RW')
                                <p>RW</p>
                            @elseif (str_replace(['[', ']', '"'], '', $titleUsers[$index]) == 'RT')
                                <p>RT {{ str_replace(['[', ']', '"'], '', $rtUsers[$index]) }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
                @for ($i = 0; $i < $counter; $i++)
                    <div class='carousel__item'>
                        <div class='carousel__item-head'>
                            <img class="profile-picture rounded-circle"
                                src="{{ 'https://img.freepik.com/free-photo/stylish-asian-girl-making-announcement-megaphone-shouting-with-speakerphone-smiling-inviting-people-recruiting-standing-blue-background_1258-89437.jpg?w=900' }}"
                                alt="Foto User" style="width: 85px; height: 85px; object-fit: cover;">
                        </div>
                        <div class='carousel__item-body'>
                            <p class='title'>Staff ke-{{ $i + 1 }}</p>
                            <p>Administrator</p>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>
    <div id="layanan" class="container container-layanan col-12 px-5">
        <h1 class="heading-center">Layanan</h1>
        <div class="row">
            <div class="col-md-3 col-sm-6 px-">
                <a href="{{ route('pengumuman.global') }}" style="text-decoration: none;">
                    <div class="card" title="Daftar Pengumuman">
                        <i class="bi bi-megaphone card-icon"></i>
                        <span class="span-head">Pengumuman Terkini</span>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6 px-">
                <a href="{{ route('umkm.global') }}" style="text-decoration: none;">
                    <div class="card" title="Pengajuan UMKM">
                        <i class="bi bi-shop-window card-icon"></i>
                        <span class="span-head">Daftar<br>UMKM </span>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6 px-">
                <a href="{{ route('pengajuandokumen.global') }}" style="text-decoration: none;">
                    <div class="card" title="Pengajuan Dokumen">
                        <i class="bi bi-file-earmark-pdf card-icon"></i>
                        <span class="span-head">Pengajuan Dokumen</span>
                    </div>
                </a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-3 col-sm-6 px-">
                <a href="{{ route('laporankeuangan.global') }}" style="text-decoration: none;">
                    <div class="card" title="Laporan Keuangan">
                        <i class="bi bi-receipt-cutoff card-icon"></i>
                        <span class="span-head">Laporan Keuangan</span>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6 px-">
                <a href="{{ route('bansos.global') }}" style="text-decoration: none;">
                    <div class="card" title="Bantuan Sosial">
                        <i style="margin-block: 1.15rem;" class="lni lni-target-customer card-icon"></i>
                        <span class="span-head">Bantuan<br>Sosial</span>
                    </div>
                </a>
            </div>
        </div>
    </div>


    <script>
        document.getElementById('selengkapnya-btn').addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelector('#layanan').scrollIntoView({
                behavior: 'smooth'
            });
        });
    </script>
@endsection
