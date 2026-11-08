<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('homepage_settings', function (Blueprint $table) {
            $table->id();
            $table->string('hero_title')->default('Lembaga Sertifikasi Profesi');
            $table->string('hero_subtitle')->nullable()->default('Bidang TIK Berlisensi BNSP');
            $table->string('hero_search_placeholder')->nullable()->default('Cari nama skema...');
            $table->string('video_url', 500)->nullable();
            $table->string('video_heading', 500)->nullable()->default('Buktikan Kompetensimu dengan Sertifikasi LSP TIK Global!');
            $table->text('video_description')->nullable();
            $table->string('benefit_heading', 500)->nullable()->default('Mengapa Memilih Sertifikasi di LSP TIK Global?');
            $table->text('benefit_description')->nullable();
            $table->json('benefit_items')->nullable();
            $table->text('benefit_closing')->nullable();
            $table->string('mitra_heading', 500)->nullable()->default('Dipercaya oleh berbagai perusahaan dan institusi pendidikan');
            $table->text('footer_description')->nullable();
            $table->string('footer_license')->nullable()->default('Lisensi BNSP: BNSP-LSP-2150-ID');
            $table->string('footer_phone')->nullable()->default('021-27651353 / +6285195533360');
            $table->string('footer_email')->nullable()->default('info@lspglobal.id');
            $table->text('footer_address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homepage_settings');
    }
};

