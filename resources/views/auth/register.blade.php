@extends('layouts.guest')

@section('content')
    <h1>Create account</h1>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <label for="name">Name</label>
        <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus autocomplete="name">
        @error('name')
            <p>{{ $message }}</p>
        @enderror

        <label for="email">Email</label>
        <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="username">
        @error('email')
            <p>{{ $message }}</p>
        @enderror

        <label for="password">Password</label>
        <input id="password" name="password" type="password" required autocomplete="new-password">
        @error('password')
            <p>{{ $message }}</p>
        @enderror

        <label for="password_confirmation">Confirm password</label>
        <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password">

        <button type="submit">Register</button>
        <a href="{{ route('login') }}">Log in</a>
    </form>
@endsection
