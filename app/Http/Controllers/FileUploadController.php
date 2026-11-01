<?php

namespace App\Http\Controllers;

use App\Models\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadController
{
    public function index(Request $request)
    {
        $files = UploadedFile::where(
            'user_id',
            $request->user()->id
        )->latest()->get();

        return view('files.index', compact('files'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => [
                'required',
                'file',
                'max:10240',
                'mimes:pdf,csv,xlsx,txt,jpg,png',
            ],
        ]);

        $file = $request->file('file');

        $path = $file->store(
            'uploads/' . $request->user()->id,
            's3'
        );

        if (!$path) {
            abort(500, 'Upload failed.');
        }

        UploadedFile::create([
            'user_id' => $request->user()->id,
            'original_name' => $file->getClientOriginalName(),
            'storage_path' => $path,
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
        ]);

        return back()->with('success', 'File uploaded successfully.');
    }

    public function download(Request $request, UploadedFile $file)
    {
        abort_unless(
            $file->user_id === $request->user()->id,
            403
        );

        return Storage::disk('s3')->download(
            $file->storage_path,
            $file->original_name
        );
    }
}
