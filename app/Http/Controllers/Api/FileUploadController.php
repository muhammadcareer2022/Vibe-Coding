<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\FileStorageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function __construct(
        protected FileStorageService $storage
    ) {}

    /**
     * Upload a file.
     */
    public function upload(Request $request): JsonResponse
    {
        $request->validate([
            'file' => ['required', 'file', 'max:10240'], // max 10MB
            'disk' => ['nullable', 'string', 'in:local,public,s3'],
            'directory' => ['nullable', 'string'],
        ]);

        $disk = $request->input('disk', 'public');
        $directory = $request->input('directory', 'uploads');

        $result = $this->storage->upload(
            file: $request->file('file'),
            directory: $directory,
            disk: $disk,
        );

        return response()->json([
            'message' => 'File uploaded successfully',
            'data' => $result,
        ], 201);
    }
}

