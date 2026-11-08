<?php

namespace App\Filament\Resources\HomepageSettings;

use App\Filament\Resources\HomepageSettings\Pages\CreateHomepageSetting;
use App\Filament\Resources\HomepageSettings\Pages\EditHomepageSetting;
use App\Filament\Resources\HomepageSettings\Pages\ListHomepageSettings;
use App\Filament\Resources\HomepageSettings\Schemas\HomepageSettingForm;
use App\Filament\Resources\HomepageSettings\Tables\HomepageSettingsTable;
use App\Models\HomepageSetting;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class HomepageSettingResource extends Resource
{
    protected static ?string $model = HomepageSetting::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedGlobeAlt;

    protected static UnitEnum|string|null $navigationGroup = 'Content Management';

    protected static ?string $navigationLabel = 'Homepage Settings';

    protected static ?string $recordTitleAttribute = 'hero_title';

    public static function canCreate(): bool
    {
        return HomepageSetting::count() === 0;
    }

    public static function form(Schema $schema): Schema
    {
        return HomepageSettingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HomepageSettingsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListHomepageSettings::route('/'),
            'create' => CreateHomepageSetting::route('/create'),
            'edit' => EditHomepageSetting::route('/{record}/edit'),
        ];
    }
}
