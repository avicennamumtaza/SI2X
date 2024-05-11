@extends('layouts.auth')

@section('content')
    <div class="form-header">
        <a href="{{ route('login') }}">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h2>Reset Password</h2>
    </div>

    <img class="sirw_icon" src="{{ asset('assets/Logo.png') }}" alt="">

    <div class="card-body">

        @error('email')
            {{-- <span class="invalid-feedback" role="alert"> --}}
                <strong>{{ $message }}</strong>
            {{-- </span> --}}
        @enderror

        @error('password')
            {{-- <span class="invalid-feedback" role="alert"> --}}
                <strong>{{ $message }}</strong>
            {{-- </span> --}}
        @enderror

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ $email ?? old('email') }}" placeholder="Email" required autocomplete="email" autofocus>

            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" placeholder="Password" required autocomplete="new-password">

            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                placeholder="Confirm Password" required autocomplete="new-password">

            <button type="submit" class="btn btn-primary">
                Reset Password
            </button>

        </form>
    @endsection
