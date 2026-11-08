<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\AdminUserSeeder;
use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class FilamentPanelAccessTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleAndPermissionSeeder::class);
    }

    public function test_guest_is_redirected_to_login_when_accessing_admin(): void
    {
        $response = $this->get('/admin');

        $response->assertRedirect('/admin/login');
    }

    public function test_admin_can_access_filament_dashboard(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $response = $this->actingAs($admin)->get('/admin');

        $response->assertSuccessful();
    }

    public function test_regular_user_cannot_access_filament_dashboard(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');

        $response = $this->actingAs($user)->get('/admin');

        $response->assertForbidden();
    }

    public function test_super_admin_seeder_creates_valid_filament_admin(): void
    {
        $this->seed(AdminUserSeeder::class);

        $superAdmin = User::where('email', 'admin@gmail.com')->first();

        $this->assertNotNull($superAdmin);
        $this->assertEquals('muhammad', $superAdmin->name);
        $this->assertTrue(Hash::check('123456', $superAdmin->password));
        $this->assertTrue($superAdmin->hasRole('admin'));

        // Test Filament admin panel access
        $response = $this->actingAs($superAdmin)->get('/admin');
        $response->assertSuccessful();
    }
}
