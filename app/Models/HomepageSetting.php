<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomepageSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'hero_title',
        'hero_subtitle',
        'hero_search_placeholder',
        'video_url',
        'video_heading',
        'video_description',
        'benefit_heading',
        'benefit_description',
        'benefit_items',
        'benefit_closing',
        'mitra_heading',
        'footer_description',
        'footer_license',
        'footer_phone',
        'footer_email',
        'footer_address',
    ];

    protected function casts(): array
    {
        return [
            'benefit_items' => 'array',
        ];
    }

    /**
     * Get or create single row settings.
     */
    public static function getSettings(): self
    {
        return self::firstOrCreate(
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
    }
}

