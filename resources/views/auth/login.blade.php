@extends('layouts.auth')

@section('content')
    <div class="form-header">
        <a href="#"onclick="goBack()">
            <i class="bi bi-arrow-left" title="Kembali"></i>
        </a>
        <h2>Masuk</h2>
    </div>
    <img class="sirw_icon" src="{{ asset('assets/Logo.png') }}" alt="">

    <div class="card-body">
        @error('password')
            {{-- <div class="invalid-feedback" role="alert"> --}}
            <strong>{{ $message }}</strong>
        </div>
    @enderror
    @error('email')
        {{-- <div class="invalid-feedback" role="alert"> --}}
        <strong>{{ $message }}</strong>
        </div>
    @enderror
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror"
            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

        <input id="password" type="password" placeholder="Password"
            class="form-control @error('email') is-invalid @enderror" name="password" required
            autocomplete="current-password">

        @if (Route::has('password.request'))
            <a class="btn btn-link" title="Klik jika lupa password." href="{{ route('password.request') }}">
                Lupa Password?
            </a>
        @endif

        <button type="submit" class="btn btn-primary" title="Masuk">
            Masuk
        </button>

    </form>
    </div>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
@endsection
