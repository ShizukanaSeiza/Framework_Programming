<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Ubah enum dengan raw SQL (karena Laravel tidak bisa ubah enum langsung via Blueprint)
        DB::statement("ALTER TABLE ekyc_registrations MODIFY COLUMN status ENUM('draft', 'submitted', 'accepted','rejected') DEFAULT 'draft'");
    }

    public function down(): void
    {
        // Rollback ke enum semula
        DB::statement("ALTER TABLE ekyc_registrations MODIFY COLUMN status ENUM('draft', 'submitted') DEFAULT 'draft'");
    }
};
