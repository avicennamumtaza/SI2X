@extends('layouts.app')

@section('content')
    <div id="beranda" class="container container-landing col-10">
        <div class="row custom-section">
            <div class="col-12 col-lg-5">
                <h2>Selamat Datang</h2>
                <h5>Pendaratan yang sempurna!</h5>
                <p>Mempersembahkan solusi modern untuk kita bersama memaksimalkan optimalisasi layanan dengan pendekatan
                    yang lebih efisien melalui SIRW sebagai salah satu upaya mendorong kemajuan dan kolaborasi dalam
                    menjawab kebutuhan sehari-hari di lingkungan Rukun Warga.</p>
                <a href="#stats" title="Selengkapnya">Selengkapnya</a>
            </div>
        </div>
    </div>
    <img src="{{ asset('assets/landing-pict.png') }}" alt="background" class="main-image">
    <div id="stats" class="container container-statsngal col-10">
        <h1 class="heading-center">Statistik</h1>
        <div class="row">
            <div class="col-md-2 col-sm-4">
                <div class="card">
                    <i class="bi bi-person-check card-icon"></i>
                    <span class="span-count">{{ $data['jumlah_penduduk'] }}</span>
                    <span class="span-head">Penduduk Terdata</span>
                </div>
            </div>
            <div class="col-md-2 col-sm-4">
                <div class="card">
                    <i class="bi bi-house-door card-icon"></i>
                    <span class="span-count">{{ $data['jumlah_keluarga'] }}</span>
                    <span class="span-head">Keluarga Terdata</span>
                </div>
            </div>
            <div class="col-md-2 col-sm-4">
                <div class="card">
                    <i class="bi bi-person-badge card-icon"></i>
                    <span class="span-count">{{ $data['jumlah_rt'] }}</span>
                    <span class="span-head">Rukun Tetangga</span>
                </div>
            </div>
            <div class="col-md-2 col-sm-4">
                <div class="card">
                    <i class="bi bi-megaphone card-icon"></i>
                    <span class="span-count">{{ $data['jumlah_pengumuman'] }}</span>
                    <span class="span-head">Pengumuman Diterbitkan</span>
                </div>
            </div>
            <div class="col-md-2 col-sm-4">
                <div class="card">
                    <i class="bi bi-shop-window card-icon"></i>
                    <span class="span-count">{{ $data['jumlah_umkm'] }}</span>
                    <span class="span-head">UMKM Terdaftar</span>
                </div>
            </div>
            <div class="col-md-2 col-sm-4">
                <div class="card">
                    <i class="bi bi-file-earmark-pdf card-icon"></i>
                    <span class="span-count">{{ $data['jumlah_pengajuan_dokumen'] }}</span>
                    <span class="span-head">Dokumen Diproses</span>
                </div>
            </div>
        </div>
    </div>    
    @if ($pengumuman1 != null)
    <div id="pengumuman" class="container container-pengumuman col-10">
        <h1 class="heading-center">Pengumuman Terbaru</h1>
        <div class="container">
            <div class="row justify-content-center">
                {{-- <span> --}}
                {{-- <span> --}}
                <div class="card col-md-5 p-0 m-4 border-4 rounded">
                    <img class="img-fluid rounded-bottom pengimg"
                        src="{{ $pengumuman1['foto_pengumuman'] ? asset('Foto Pengumuman/' . $pengumuman1['foto_pengumuman']) : 'https://img.freepik.com/free-photo/stylish-asian-girl-making-announcement-megaphone-shouting-with-speakerphone-smiling-inviting-people-recruiting-standing-blue-background_1258-89437.jpg?w=900' }}"
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
                <div class="card col-md-5 p-0 m-4 border-4 rounded">
                    <img class="img-fluid rounded-bottom pengimg"
                        src="{{ $pengumuman2['foto_pengumuman'] ? asset('Foto Pengumuman/' . $pengumuman2['foto_pengumuman']) : 'https://img.freepik.com/free-photo/stylish-asian-girl-making-announcement-megaphone-shouting-with-speakerphone-smiling-inviting-people-recruiting-standing-blue-background_1258-89437.jpg?w=900' }}"
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
                {{-- </span> --}}
                {{-- </span> --}}
            </div>
            <a class="position-absolute start-50 translate-middle-x" href="{{ route('pengumuman.global') }}"
                title="Pengumuman lainnya">Lainnya</a>
        </div>     
    </div>
    @endif
    <div id="" class="container container-rtrw col-10">
      <h1 class="heading-center">Kenalan</h1>
        <div class='row wrapper'>
            <div class='carousel'>
              <div class='carousel__item'>
                <div class='carousel__item-head'>
                  🐳
                </div>
                <div class='carousel__item-body'>
                  <p class='title'>spouting whale</p>
                  <p>Unicode: U+1F433</p>
                </div>
              </div>
              <div class='carousel__item'>
                <div class='carousel__item-head'>
                  🐋
                </div>
                <div class='carousel__item-body'>
                  <p class='title'>whale</p>
                  <p>Unicode: U+1F40B</p>
                </div>
              </div>
              <div class='carousel__item'>
                <div class='carousel__item-head'>
                  🐬
                </div>
                <div class='carousel__item-body'>
                  <p class='title'>dolphin</p>
                  <p>Unicode: U+1F42C</p>
                </div>
              </div>
              <div class='carousel__item'>
                <div class='carousel__item-head'>
                  🐟
                </div>
                <div class='carousel__item-body'>
                  <p class='title'>fish</p>
                  <p>Unicode: U+1F41F</p>
                </div>
              </div>
              <div class='carousel__item'>
                <div class='carousel__item-head'>
                  🐠
                </div>
                <div class='carousel__item-body'>
                  <p class='title'>tropical fish</p>
                  <p>Unicode: U+1F420</p>
                </div>
              </div>
              <div class='carousel__item'>
                <div class='carousel__item-head'>
                  🐡
                </div>
                <div class='carousel__item-body'>
                  <p class='title'>blowfish</p>
                  <p>Unicode: U+1F421</p>
                </div>
              </div>
              <div class='carousel__item'>
                <div class='carousel__item-head'>
                  🦈
                </div>
                <div class='carousel__item-body'>
                  <p class='title'>shark</p>
                  <p>Unicode: U+1F988</p>
                </div>
              </div>
              <div class='carousel__item'>
                <div class='carousel__item-head'>
                  🐙
                </div>
                <div class='carousel__item-body'>
                  <p class='title'>octopus</p>
                  <p>Unicode: U+1F419</p>
                </div>
              </div>
              <div class='carousel__item'>
                <div class='carousel__item-head'>
                  🐚
                </div>
                <div class='carousel__item-body'>
                  <p class='title'>spiral shell</p>
                  <p>Unicode: U+1F41A</p>
                </div>
              </div>
            </div>
          </div>          
        {{-- <h1 class="heading-center">Galeri RW</h1>
        <div id="carouselExampleCaptions" class="carousel slide mt-1 px-3">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="https://img.freepik.com/free-photo/stylish-asian-girl-making-announcement-megaphone-shouting-with-speakerphone-smiling-inviting-people-recruiting-standing-blue-background_1258-89437.jpg?w=900" class="d-block w-100" alt="https://img.freepik.com/free-photo/stylish-asian-girl-making-announcement-megaphone-shouting-with-speakerphone-smiling-inviting-people-recruiting-standing-blue-background_1258-89437.jpg?w=900">
                <div class="carousel-caption d-none d-md-block">
                  <h5>First slide label</h5>
                  <p>Some representative placeholder content for the first slide.</p>
                </div>
              </div>
              <div class="carousel-item">
                <img src="https://img.freepik.com/free-photo/stylish-asian-girl-making-announcement-megaphone-shouting-with-speakerphone-smiling-inviting-people-recruiting-standing-blue-background_1258-89437.jpg?w=900" class="d-block w-100" alt="https://img.freepik.com/free-photo/stylish-asian-girl-making-announcement-megaphone-shouting-with-speakerphone-smiling-inviting-people-recruiting-standing-blue-background_1258-89437.jpg?w=900">
                <div class="carousel-caption d-none d-md-block">
                  <h5>Second slide label</h5>
                  <p>Some representative placeholder content for the second slide.</p>
                </div>
              </div>
              <div class="carousel-item">
                <img src="https://img.freepik.com/free-photo/stylish-asian-girl-making-announcement-megaphone-shouting-with-speakerphone-smiling-inviting-people-recruiting-standing-blue-background_1258-89437.jpg?w=900" class="d-block w-100" alt="https://img.freepik.com/free-photo/stylish-asian-girl-making-announcement-megaphone-shouting-with-speakerphone-smiling-inviting-people-recruiting-standing-blue-background_1258-89437.jpg?w=900">
                <div class="carousel-caption d-none d-md-block">
                  <h5>Third slide label</h5>
                  <p>Some representative placeholder content for the third slide.</p>
                </div>
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div> --}}
    </div>
    <div id="layanan" class="container container-layanan col-10">
        <h1 class="heading-center">Layanan</h1>
        <!-- <div class="container"> -->
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <a href="{{ route('pengumuman.global') }}" style="text-decoration: none">
                    <button class="card" title="Daftar Pengumuman">
                        <i class="bi bi-megaphone card-icon"></i>
                        <span class="span-head">Pengumuman Terkini</span>
                    </button>
                </a>
            </div>
            <div class="col-md-3 col-sm-6">
                <a href="{{ route('umkm.global') }}" style="text-decoration: none">
                    <button class="card" title="Pengajuan UMKM">
                        <i class="bi bi-shop-window card-icon"></i>
                        <span class="span-head">Daftar UMKM</span>
                    </button>
                </a>
            </div>
            <div class="col-md-3 col-sm-6">
                <a href="{{ route('pengajuandokumen.global') }}" style="text-decoration: none">
                    <button class="card" title="Permintaan Dokumen">
                        <i class="bi bi-file-earmark-pdf card-icon"></i>
                        <span class="span-head">Permintaan Dokumen</span>
                    </button>
                </a>
            </div>
            <div class="col-md-3 col-sm-6">
                <a href="{{ route('laporankeuangan.global') }}" style="text-decoration: none">
                    <button class="card" title="Laporan Keuangan">
                        <i class="bi bi-receipt-cutoff card-icon"></i>
                        <span class="span-head">Laporan Keuangan</span>
                    </button>
                </a>
            </div>
        </div>
        <!-- </div> -->
    </div>
@endsection
