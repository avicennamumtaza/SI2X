@extends('layouts.auth')

@section('content')
    <div class="form-header">
        <a href="#">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h2>Login</h2>
    </div>
    <img class="sirw_icon" src="{{ asset('assets/landing-pict.png') }}" alt="">

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

            <input id="email" type="email" placeholder="Email"
                class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                required autocomplete="email" autofocus>

            <input id="password" type="password" placeholder="Password"
                class="form-control @error('email') is-invalid @enderror" name="password" required
                autocomplete="current-password">

            @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    Forgot Your Password?
                </a>
            @endif
            
            <button type="submit" class="btn btn-primary">
                Login
            </button>

        </form>
    </div>
@endsection
