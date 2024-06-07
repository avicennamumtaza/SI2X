@php
    use Carbon\Carbon;
    Carbon::setLocale('id');
@endphp
@extends('layouts.app')

@section('content')
    <div class="container container-p col-10">
        <h1 class="heading-center">Pengumuman</h1>
        <p>Fitur pengumuman dalam SIRW adalah sebuah sarana menfasilitasi penyebaran informasi kepada penduduk. Pengumuman
            ini dapat berupa berbagai hal, mulai dari pengumuman kegiatan sosial, keamanan lingkungan, pemberitahuan acara,
            hingga informasi urgent seperti perubahan kebijakan pemerintah.</p>
        @foreach ($pengumumans as $key => $pengumuman)
            @php
                $colors = ['blue', 'green', 'red', 'yellow'];
                $color = $colors[$key % count($colors)];
            @endphp
            <article class="postcard light {{ $color }}" title="Pengumuman">
                <a class="postcard__img_link" href="#" data-toggle="modal" data-target="#fotoModal{{ $pengumuman->id }}"
                    title="Foto Pengumuman">
                    <img class="postcard__img"
                        src="{{ $pengumuman->foto_pengumuman ? asset('Foto Pengumuman/' . $pengumuman->foto_pengumuman) : 'https://img.freepik.com/free-photo/stylish-asian-girl-making-announcement-megaphone-shouting-with-speakerphone-smiling-inviting-people-recruiting-standing-blue-background_1258-89437.jpg?w=900' }}"
                        alt="Foto Pengumuman{{ $pengumuman->id }}" data-id="{{ $pengumuman->id }}"
                        data-target="#fotoModal{{ $pengumuman->id }}" />
                </a>

                <div class="postcard__text t-dark">
                    <h1 class="postcard__title {{ $color }}" title="Judul Pengumuman">{{ $pengumuman->judul }}</h1>
                    {{-- <div class="postcard__bar"></div> --}}
                    <div class="my-1"></div>
                    <div class="postcard__preview-txt" title="Deskripsi Pengumuman">
                        {{ $pengumuman->deskripsi }}
                    </div>
                    {{-- <ul class="postcard__tagbox">
                        <li class="tag__item" title="Tanggal Pengumuman"> --}}
                            {{-- <i class="fas fa-tag mr-2"></i> --}}
                            <div class="mt-2">
                                <hr>
                                {{-- ---------------------------------- --}}
                                {{ Carbon::parse($pengumuman->tanggal)->translatedFormat('d F Y') }}
                                {{-- ---------------------------------- --}}
                            </div>
                        {{-- </li>
                    </ul> --}}
                </div>
            </article>
        @endforeach
    </div>

    <!-- Modal untuk setiap UMKM -->
    @if (isset($pengumuman) && !empty($pengumuman))
        <div class="modal fade" id="fotoModal{{ $pengumuman->id }}" tabindex="-1" role="dialog"
            aria-labelledby="fotoModalLabel{{ $pengumuman->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between">
                        <h5 class="modal-title" id="fotoModalLabel{{ $pengumuman->id }}">{{ $pengumuman->judul }}</h5>
                        <i class="bi bi-x-lg text-danger" data-dismiss="modal" aria-label="Close"
                            style="font-size: 1.5rem; cursor: pointer;"></i>
                    </div>
                    <div class="modal-body">
                        <img id="modalImg{{ $pengumuman->id }}"
                            src="{{ $pengumuman->foto_pengumuman ? asset('Foto pengumuman/' . $pengumuman->foto_pengumuman) : 'https://img.freepik.com/free-photo/stylish-asian-girl-making-announcement-megaphone-shouting-with-speakerphone-smiling-inviting-people-recruiting-standing-blue-background_1258-89437.jpg?w=900' }}"
                            class="img-fluid" alt="Foto pengumuman{{ $pengumuman->id }}"
                            style="min-width: 100%; max-height: auto;">
                    </div>
                </div>
            </div>
        </div>
    @endif



    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Mengatur modal yang akan ditampilkan ketika gambar pengumuman diklik
        $(document).ready(function() {
            $('.postcard__img_link').click(function() {
                var id = $(this).find('img').data('id');
                var modalTarget = $(this).find('img').data('target');
                var imgUrl = $(this).find('img').attr('src');

                $('#fotoModalLabel').text($('#fotoModalLabel' + id).text());
                $('#modalImg').attr('src', imgUrl);
                $('#fotoModal').modal('show');
            });
        });
    </script>
@endsection
