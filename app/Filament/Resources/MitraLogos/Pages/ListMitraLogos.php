<?php

namespace App\Filament\Resources\MitraLogos\Pages;

use App\Filament\Resources\MitraLogos\MitraLogoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMitraLogos extends ListRecords
{
    protected static string $resource = MitraLogoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
