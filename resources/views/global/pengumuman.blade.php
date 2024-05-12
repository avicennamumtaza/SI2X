@extends('layouts.app')

@section('content')
    <div class="container container-p col-10">
        <h1 class="heading-center">Pengumuman</h1>
        <!-- <div class="container"> -->
        <p>Fitur pengumuman dalam SIRW adalah sebuah sarana menfasilitasi penyebaran informasi kepada penduduk. Pengumuman
            ini dapat berupa berbagai hal, mulai dari pengumuman kegiatan sosial, keamanan lingkungan, pemberitahuan acara,
            hingga informasi urgent seperti perubahan kebijakan pemerintah.</p>
        @foreach ($pengumumans as $pengumuman)
            <article class="postcard light blue">
                <a class="postcard__img_link" href="#" data-toggle="modal" data-target="#fotoModal{{ $pengumuman->id }}">
                    <img class="postcard__img"
                        src="{{ $pengumuman->foto_pengumuman ? asset('Foto Pengumuman/' . $pengumuman->foto_pengumuman) : 'https://img.freepik.com/free-photo/stylish-asian-girl-making-announcement-megaphone-shouting-with-speakerphone-smiling-inviting-people-recruiting-standing-blue-background_1258-89437.jpg?w=900' }}"
                        alt="Foto Pengumuman{{ $pengumuman->id }}" data-id="{{ $pengumuman->id }}"
                        data-target="#fotoModal{{ $pengumuman->id }}" />
                </a>

                <div class="postcard__text t-dark">
                    <h1 class="postcard__title blue">{{ $pengumuman->judul }}</h1>
                    <div class="postcard__subtitle small">
                        <time datetime="2020-05-25 12:00:00">
                            <i class="fas fa-calendar-alt mr-2"></i>
                            {{ $pengumuman->tanggal_pengumuman }}
                        </time>
                    </div>
                    <div class="postcard__bar"></div>
                    <div class="postcard__preview-txt">
                        {{ $pengumuman->deskripsi }}
                    </div>
                    <ul class="postcard__tagbox">
                        <li class="tag__item"><i class="fas fa-tag mr-2"></i>{{ $pengumuman->tanggal }}</li>
                    </ul>
                </div>
            </article>
        @endforeach
    </div>
    <!-- Modals untuk menampilkan foto pengumuman secara penuh -->
    <div class="modal fade" id="fotoModal" tabindex="-1" role="dialog" aria-labelledby="fotoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="fotoModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img id="modalImg" src="" class="img-fluid" alt="Foto Pengumuman"
                        style="max-width: 100%; height: 100%;">
                </div>
            </div>
        </div>
    </div>


    <!-- Pastikan jQuery dan Bootstrap dimuat dengan benar -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
