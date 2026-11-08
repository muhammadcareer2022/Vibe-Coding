<?php

namespace App\Filament\Resources\HomepageSettings\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class HomepageSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Hero Section')
                    ->description('Kelola teks judul dan pencarian pada bagian paling atas homepage.')
                    ->schema([
                        TextInput::make('hero_title')
                            ->label('Judul Utama Hero')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('hero_subtitle')
                            ->label('Subjudul Hero')
                            ->maxLength(255),
                        TextInput::make('hero_search_placeholder')
                            ->label('Placeholder Search Bar')
                            ->maxLength(255),
                    ]),

                Section::make('Video Section')
                    ->description('Kelola video promosi/profil dan deskripsi pendukung.')
                    ->schema([
                        TextInput::make('video_url')
                            ->label('URL Embed Video (YouTube)')
                            ->url()
                            ->placeholder('https://www.youtube.com/embed/xxxxx')
                            ->maxLength(500),
                        TextInput::make('video_heading')
                            ->label('Judul Video Section')
                            ->maxLength(500),
                        Textarea::make('video_description')
                            ->label('Deskripsi Video Section')
                            ->rows(3),
                    ]),

                Section::make('Benefit Section')
                    ->description('Kelola keunggulan sertifikasi (judul, kartu benefit, dan penutup).')
                    ->schema([
                        TextInput::make('benefit_heading')
                            ->label('Judul Benefit')
                            ->maxLength(500),
                        Textarea::make('benefit_description')
                            ->label('Deskripsi Pengantar Benefit')
                            ->rows(3),
                        Repeater::make('benefit_items')
                            ->label('Daftar Poin Keunggulan (Benefit)')
                            ->schema([
                                TextInput::make('title')
                                    ->label('Judul Poin')
                                    ->required(),
                                Textarea::make('description')
                                    ->label('Keterangan Poin')
                                    ->rows(2)
                                    ->required(),
                                TextInput::make('icon')
                                    ->label('Icon Identifier')
                                    ->default('heroicon-o-check-badge'),
                            ])
                            ->defaultItems(3),
                        Textarea::make('benefit_closing')
                            ->label('Teks Penutup Benefit')
                            ->rows(2),
                    ]),

                Section::make('Mitra Section')
                    ->description('Judul untuk deretan logo mitra yang berjalan.')
                    ->schema([
                        TextInput::make('mitra_heading')
                            ->label('Judul Mitra')
                            ->maxLength(500),
                    ]),

                Section::make('Footer Section')
                    ->description('Kelola identitas resmi LSP, lisensi, dan informasi kontak.')
                    ->schema([
                        Textarea::make('footer_description')
                            ->label('Deskripsi Singkat LSP')
                            ->rows(3),
                        TextInput::make('footer_license')
                            ->label('Nomor Lisensi BNSP')
                            ->maxLength(255),
                        TextInput::make('footer_phone')
                            ->label('No. Telepon / WhatsApp')
                            ->maxLength(255),
                        TextInput::make('footer_email')
                            ->label('Email Resmi')
                            ->email()
                            ->maxLength(255),
                        Textarea::make('footer_address')
                            ->label('Alamat Kantor')
                            ->rows(3),
                    ]),
            ]);
    }
}
