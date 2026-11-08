<?php

namespace App\Filament\Resources\MitraLogos;

use App\Filament\Resources\MitraLogos\Pages\CreateMitraLogo;
use App\Filament\Resources\MitraLogos\Pages\EditMitraLogo;
use App\Filament\Resources\MitraLogos\Pages\ListMitraLogos;
use App\Filament\Resources\MitraLogos\Schemas\MitraLogoForm;
use App\Filament\Resources\MitraLogos\Tables\MitraLogosTable;
use App\Models\MitraLogo;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class MitraLogoResource extends Resource
{
    protected static ?string $model = MitraLogo::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingOffice;

    protected static UnitEnum|string|null $navigationGroup = 'Content Management';

    protected static ?string $navigationLabel = 'Mitra Logos';

    public static function form(Schema $schema): Schema
    {
        return MitraLogoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MitraLogosTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMitraLogos::route('/'),
            'create' => CreateMitraLogo::route('/create'),
            'edit' => EditMitraLogo::route('/{record}/edit'),
        ];
    }
}
