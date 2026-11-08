<?php

namespace Database\Seeders;

use App\Models\HomepageSetting;
use App\Models\MitraLogo;
use Illuminate\Database\Seeder;

class HomepageSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Seed default Homepage Settings
        HomepageSetting::updateOrCreate(
            ['id' => 1],
            [
                'hero_title' => 'Lembaga Sertifikasi Profesi',
                'hero_subtitle' => 'Bidang TIK Berlisensi BNSP',
                'hero_search_placeholder' => 'Cari nama skema...',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'video_heading' => 'Buktikan Kompetensimu dengan Sertifikasi LSP TIK Global!',
                'video_description' => 'Sertifikasi kompetensi kerja adalah proses pemberian sertifikat kompetensi yang dilakukan secara sistematis dan obyektif melalui uji kompetensi.',
                'benefit_heading' => 'Mengapa Memilih Sertifikasi di LSP TIK Global?',
                'benefit_description' => 'Bukan sekadar dokumen, ini adalah investasi terbaik untuk memvalidasi keahlian Anda, diakui secara resmi oleh negara, dan memenangkan persaingan di industri kerja.',
                'benefit_items' => [
                    [
                        'title' => 'Sertifikat Kompetensi Diakui Secara Nasional',
                        'description' => 'Memiliki sertifikat kompetensi resmi dari BNSP RI sebagai bukti sah keterampilan Anda.',
                        'icon' => 'heroicon-o-check-badge',
                    ],
                    [
                        'title' => 'Skema Sertifikasi Berbasis SKKNI',
                        'description' => 'Seluruh skema sertifikasi mengacu pada SKKNI dan peraturan ESDM terbaru serta kebutuhan industri.',
                        'icon' => 'heroicon-o-document-text',
                    ],
                    [
                        'title' => 'Jaringan TUK di Berbagai Daerah',
                        'description' => 'Memiliki jaringan Tempat Uji Kompetensi (TUK) yang luas dan tersebar di berbagai wilayah Indonesia.',
                        'icon' => 'heroicon-o-map-pin',
                    ],
                ],
                'benefit_closing' => 'Dengan sertifikasi LSP TIK Global, kompetensimu tidak hanya diakui, tapi juga membuka peluang lebih luas untuk karier dan masa depan yang gemilang.',
                'mitra_heading' => 'Dipercaya oleh berbagai perusahaan dan institusi pendidikan',
                'footer_description' => 'LSP TIK Global – Lembaga Sertifikasi Profesi bidang Teknologi Informasi & Komunikasi berlisensi BNSP, siap mencetak SDM TIK unggul dan kompeten.',
                'footer_license' => 'Lisensi BNSP: BNSP-LSP-2150-ID',
                'footer_phone' => '021-27651353 / +6285195533360',
                'footer_email' => 'info@lspglobal.id',
                'footer_address' => 'Jl. Lebak Bulus Raya Komplek Ruko Victory 88 No. 88 B Cilandak Jakarta Selatan',
            ]
        );

        // 2. Seed default sample Mitra Logos
        $sampleMitras = [
            ['name' => 'Kementerian Komunikasi dan Digital', 'logo' => 'https://placehold.co/200x80/2563eb/ffffff?text=Komdigi', 'url' => 'https://komdigi.go.id', 'is_active' => true, 'sort_order' => 1],
            ['name' => 'Badan Nasional Sertifikasi Profesi', 'logo' => 'https://placehold.co/200x80/059669/ffffff?text=BNSP', 'url' => 'https://bnsp.go.id', 'is_active' => true, 'sort_order' => 2],
            ['name' => 'Universitas Indonesia', 'logo' => 'https://placehold.co/200x80/eab308/ffffff?text=Univ+Indonesia', 'url' => 'https://ui.ac.id', 'is_active' => true, 'sort_order' => 3],
            ['name' => 'Institut Teknologi Bandung', 'logo' => 'https://placehold.co/200x80/0284c7/ffffff?text=ITB', 'url' => 'https://itb.ac.id', 'is_active' => true, 'sort_order' => 4],
            ['name' => 'Telkom Indonesia', 'logo' => 'https://placehold.co/200x80/dc2626/ffffff?text=Telkom', 'url' => 'https://telkom.co.id', 'is_active' => true, 'sort_order' => 5],
            ['name' => 'Bank Mandiri', 'logo' => 'https://placehold.co/200x80/1d4ed8/ffffff?text=Mandiri', 'url' => 'https://bankmandiri.co.id', 'is_active' => true, 'sort_order' => 6],
            ['name' => 'Mitra Non-Aktif Test', 'logo' => 'https://placehold.co/200x80/64748b/ffffff?text=Hidden', 'url' => null, 'is_active' => false, 'sort_order' => 99],
        ];

        foreach ($sampleMitras as $mitra) {
            MitraLogo::updateOrCreate(['name' => $mitra['name']], $mitra);
        }
    }
}

