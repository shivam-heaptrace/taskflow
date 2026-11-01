@extends('layouts.guest')

@section('content')
    <h1>Log in</h1>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <label for="email">Email</label>
        <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="username">
        @error('email')
            <p>{{ $message }}</p>
        @enderror

        <label for="password">Password</label>
        <input id="password" name="password" type="password" required autocomplete="current-password">
        @error('password')
            <p>{{ $message }}</p>
        @enderror

        <label>
            <input name="remember" type="checkbox">
            Remember me
        </label>

        <button type="submit">Log in</button>
        <a href="{{ route('register') }}">Create account</a>
    </form>
@endsection
