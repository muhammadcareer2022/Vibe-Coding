<?php

namespace Tests\Feature;

use App\Models\HomepageSetting;
use App\Models\MitraLogo;
use App\Models\User;
use App\Services\HomepageService;
use Database\Seeders\HomepageSettingsSeeder;
use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomepageTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleAndPermissionSeeder::class);
        $this->seed(HomepageSettingsSeeder::class);
    }

    public function test_homepage_can_be_rendered_successfully(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Lembaga Sertifikasi Profesi');
        $response->assertSee('Bidang TIK Berlisensi BNSP');
        $response->assertSee('Buktikan Kompetensimu dengan Sertifikasi LSP TIK Global!');
        $response->assertSee('Mengapa Memilih Sertifikasi di LSP TIK Global?');
        $response->assertSee('BNSP-LSP-2150-ID');
        $response->assertSee('info@lspglobal.id');
    }

    public function test_homepage_displays_active_mitras_and_hides_inactive_ones(): void
    {
        MitraLogo::create([
            'name' => 'Active Partner XYZ',
            'logo' => 'https://placehold.co/200x80?text=Active',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        MitraLogo::create([
            'name' => 'Inactive Partner ABC',
            'logo' => 'https://placehold.co/200x80?text=Inactive',
            'is_active' => false,
            'sort_order' => 2,
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Active Partner XYZ');
        $response->assertDontSee('Inactive Partner ABC');
    }

    public function test_homepage_service_returns_structured_data(): void
    {
        $service = app(HomepageService::class);
        $data = $service->getHomepageData();

        $this->assertArrayHasKey('settings', $data);
        $this->assertArrayHasKey('mitras', $data);
        $this->assertInstanceOf(HomepageSetting::class, $data['settings']);
        $this->assertTrue($data['mitras']->every(fn ($m) => $m->is_active === true));
    }

    public function test_admin_can_access_filament_homepage_settings(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $response = $this->actingAs($admin)->get('/admin/homepage-settings');
        $response->assertSuccessful();

        $responseMitra = $this->actingAs($admin)->get('/admin/mitra-logos');
        $responseMitra->assertSuccessful();
    }
}

