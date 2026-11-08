<?php

namespace App\Filament\Resources\MitraLogos\Pages;

use App\Filament\Resources\MitraLogos\MitraLogoResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMitraLogo extends EditRecord
{
    protected static string $resource = MitraLogoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
