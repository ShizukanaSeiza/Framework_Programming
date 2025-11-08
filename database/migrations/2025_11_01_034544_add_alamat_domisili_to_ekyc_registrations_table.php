<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ekyc_registrations', function (Blueprint $table) {
            $table->string('alamatDomisili')->nullable()->after('file_ijazah');
            $table->string('provinsi', 100)->nullable()->after('alamat');
            $table->string('kota', 100)->nullable()->after('provinsi');
            $table->string('kecamatan', 100)->nullable()->after('kota');
            $table->string('kode_pos', 10)->nullable()->after('kecamatan');
            $table->string('nama_ibu_kandung', 100)->nullable()->after('kode_pos');
            $table->string('referensi_sumber', 50)->nullable()->after('nama_ibu_kandung');
        });
    }

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
                'referensi_sumber',
            ]);
        });
    }
};