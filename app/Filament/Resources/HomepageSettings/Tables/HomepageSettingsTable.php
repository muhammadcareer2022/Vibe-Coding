<?php

namespace App\Filament\Resources\HomepageSettings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class HomepageSettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('hero_title')
                    ->label('Judul Hero')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('hero_subtitle')
                    ->label('Subjudul Hero')
                    ->searchable(),
                TextColumn::make('footer_phone')
                    ->label('Kontak Telepon'),
                TextColumn::make('updated_at')
                    ->label('Terakhir Diperbarui')
                    ->dateTime()
                    ->sortable(),
            ])
            ->actions([
                EditAction::make(),
            ]);
    }
}
