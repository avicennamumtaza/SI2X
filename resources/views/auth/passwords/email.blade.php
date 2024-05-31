@extends('layouts.auth')

@section('content')
    <div class="form-header">
        <a href="{{ route('login') }}" title="Kembali">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h2>Lupa Password</h2>
    </div>

    <img class="sirw_icon" src="{{ asset('assets/Logo.png') }}" alt="">

    <div class="card-body">

        @if (session('status'))
            {{-- <div class="alert alert-success" role="alert"> --}}
            {{ session('status') }}
            {{-- </div> --}}
        @endif

        @error('email')
            {{-- <span class="invalid-feedback" role="alert"> --}}
            <strong>{{ $message }}</strong>
            {{-- </span> --}}
        @enderror

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <input id="email" type="email" placeholder="Email"
                class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                required autocomplete="email" autofocus>

            <button type="submit" class="btn btn-primary" title="Kirim link ke email di atas">
                Kirim Link
            </button>

        </form>
    </div>
@endsection
