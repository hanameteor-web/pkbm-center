@extends('layouts.guest')

@section('content')

<form method="POST" action="{{ route('login') }}">

    @csrf

    {{-- EMAIL --}}
    <div class="form-group">

        <label
            for="email"
            class="form-label"
        >
            Email
        </label>

        <div class="input-wrapper">

            <i class="fa-solid fa-envelope input-icon"></i>

            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="username"
                placeholder="Masukkan email"
                class="login-input"
            >

        </div>

        @if($errors->get('email'))

            <div class="form-error">
                {{ $errors->first('email') }}
            </div>

        @endif

    </div>


    {{-- PASSWORD --}}
    <div class="form-group">

        <label
            for="password"
            class="form-label"
        >
            Password
        </label>

        <div class="input-wrapper">

            <i class="fa-solid fa-lock input-icon"></i>

            <input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                placeholder="Masukkan password"
                class="login-input"
            >

        </div>

        @if($errors->get('password'))

            <div class="form-error">
                {{ $errors->first('password') }}
            </div>

        @endif

    </div>


    {{-- INGAT SAYA --}}
    <div class="remember-row">

        <div class="remember-left">

            <input
                id="remember_me"
                type="checkbox"
                name="remember"
                class="remember-checkbox"
            >

            <label
                for="remember_me"
                class="remember-label"
            >
                Ingat saya
            </label>

        </div>
        

    </div>


    {{-- TOMBOL MASUK --}}
    <button
        type="submit"
        class="login-button"
    >

        <i class="fa-solid fa-right-to-bracket"></i>

        Masuk

    </button>

</form>

@endsection