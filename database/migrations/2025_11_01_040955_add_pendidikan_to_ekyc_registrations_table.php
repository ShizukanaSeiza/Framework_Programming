<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
    
    public function up(): void
    {
        Schema::table('ekyc_registrations', function (Blueprint $table) {
            $table->string('asal_sd')->nullable()->after('file_selfie');
            $table->string('asal_smp')->nullable()->after('asal_sd');
            $table->string('asal_sma')->nullable()->after('asal_smp');
        });
    }

    public function down(): void
    {
        Schema::table('ekyc_registrations', function (Blueprint $table) {
            $table->dropColumn(['asal_sd', 'asal_smp', 'asal_sma']);
        });
    }
};
