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
        Schema::table('keluarga', function (Blueprint $table) {
            // Drop the existing primary key on no_kk
            $table->dropPrimary(['no_kk']);

            // Add a composite primary key
            $table->primary(['no_kk', 'tahun_data']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('keluarga', function (Blueprint $table) {
            // Drop the composite primary key
            $table->dropPrimary(['no_kk', 'tahun_data']);

            // Add the primary key back to no_kk
            $table->primary('no_kk');
        });
    }
};
