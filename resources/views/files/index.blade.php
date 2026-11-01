@extends('layouts.app')

@section('content')
    <h1>My Files</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <form method="POST" action="{{ route('files.store') }}" enctype="multipart/form-data">
        @csrf
        <label for="file">Choose a file (PDF, CSV, XLSX, TXT, JPG or PNG; max 10 MB)</label>
        <input id="file" name="file" type="file" required>
        @error('file')
            <p>{{ $message }}</p>
        @enderror
        <button type="submit">Upload</button>
    </form>

    <h2>Uploaded Files</h2>
    <ul>
        @foreach ($files as $file)
            <li>
                {{ $file->original_name }}
                <a href="{{ route('files.download', $file) }}">Download</a>
            </li>
        @endforeach
    </ul>
@endsection
