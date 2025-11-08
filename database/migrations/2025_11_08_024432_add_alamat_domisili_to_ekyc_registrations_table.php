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
        Schema::table('ekyc_registrations', function (Blueprint $table) {
            $table->string('alamatDomisili')->nullable()->after('file_ijazah');
            $table->string('provinsi')->nullable()->after('alamat');
            $table->string('kota')->nullable()->after('provinsi');
            $table->string('kecamatan')->nullable()->after('kota');
            $table->string('kode_pos')->nullable()->after('kecamatan');
            $table->string('nama_ibu_kandung')->nullable()->after('kode_pos');
            $table->string('referensi_sumber')->nullable()->after('nama_ibu_kandung');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ekyc_registrations', function (Blueprint $table) {
            $table->dropColumn([
                'alamatDomisili',
                'provinsi',
                'kota',
                'kecamatan',
                'kode_pos',
                'nama_ibu_kandung',
                'referensi_sumber'
            ]);
        });
    }
};
