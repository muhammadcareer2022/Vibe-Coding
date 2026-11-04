<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileUploadTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleAndPermissionSeeder::class);
    }

    public function test_user_with_permission_can_upload_file(): void
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $user->assignRole('user'); // has 'upload-files' permission

        $file = UploadedFile::fake()->create('document.pdf', 100, 'application/pdf');

        $response = $this->actingAs($user, 'sanctum')->postJson('/api/files/upload', [
            'file' => $file,
            'disk' => 'public',
            'directory' => 'test-uploads',
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'message',
                'data' => ['disk', 'path', 'url', 'original_name', 'mime_type', 'size'],
            ]);

        $path = $response->json('data.path');
        Storage::disk('public')->assertExists($path);
    }

    public function test_user_without_permission_cannot_upload_file(): void
    {
        Storage::fake('public');

        $user = User::factory()->create(); // no role or permission

        $file = UploadedFile::fake()->create('document.pdf', 100, 'application/pdf');

        $response = $this->actingAs($user, 'sanctum')->postJson('/api/files/upload', [
            'file' => $file,
        ]);

        $response->assertStatus(403);
    }

    public function test_guest_cannot_upload_file(): void
    {
        $file = UploadedFile::fake()->create('document.pdf', 100, 'application/pdf');

        $response = $this->postJson('/api/files/upload', [
            'file' => $file,
        ]);

        $response->assertStatus(401);
    }
}

