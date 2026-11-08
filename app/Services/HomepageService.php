<?php

namespace App\Services;

use App\Models\HomepageSetting;
use App\Models\MitraLogo;
use Illuminate\Support\Collection;

class HomepageService
{
    /**
     * Get all homepage data required for rendering.
     *
     * @return array{settings: HomepageSetting, mitras: Collection<int, MitraLogo>}
     */
    public function getHomepageData(): array
    {
        $settings = HomepageSetting::getSettings();
        $mitras = MitraLogo::active()->get();

        return [
            'settings' => $settings,
            'mitras' => $mitras,
        ];
    }
}

