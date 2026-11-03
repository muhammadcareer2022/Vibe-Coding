<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileStorageService
{
    /**
     * Upload an uploaded file to the specified disk.
     *
     * @return array{disk: string, path: string, url: string, original_name: string, mime_type: string, size: int}
     */
    public function upload(
        UploadedFile $file,
        string $directory = 'uploads',
        ?string $disk = null,
        string $visibility = 'public'
    ): array {
        $disk = $disk ?? config('filesystems.default', 'local');
        $filename = Str::uuid().'.'.$file->getClientOriginalExtension();
        $path = $file->storeAs($directory, $filename, [
            'disk' => $disk,
            'visibility' => $visibility,
        ]);

        return [
            'disk' => $disk,
            'path' => $path,
            'url' => Storage::disk($disk)->url($path),
            'original_name' => $file->getClientOriginalName(),
            'mime_type' => $file->getClientMimeType(),
            'size' => $file->getSize(),
        ];
    }

    /**
     * Delete a file from disk.
     */
    public function delete(string $path, ?string $disk = null): bool
    {
        $disk = $disk ?? config('filesystems.default', 'local');

        return Storage::disk($disk)->delete($path);
    }

    /**
     * Check if a file exists on disk.
     */
    public function exists(string $path, ?string $disk = null): bool
    {
        $disk = $disk ?? config('filesystems.default', 'local');

        return Storage::disk($disk)->exists($path);
    }

    /**
     * Get the URL for a stored file.
     */
    public function url(string $path, ?string $disk = null): string
    {
        $disk = $disk ?? config('filesystems.default', 'local');

        return Storage::disk($disk)->url($path);
    }

    /**
     * Retrieve the file contents.
     */
    public function get(string $path, ?string $disk = null): ?string
    {
        $disk = $disk ?? config('filesystems.default', 'local');

        return Storage::disk($disk)->get($path);
    }
}

