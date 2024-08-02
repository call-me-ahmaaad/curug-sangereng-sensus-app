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
            $table->string('tahun_data')->after('rw'); // Adjust the column position if needed
            $table->unique(['no_kk', 'tahun_data']); // Add unique constraint
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('keluarga', function (Blueprint $table) {
            $table->dropUnique(['no_kk', 'tahun_data']); // Drop the unique constraint
            $table->dropColumn('tahun_data'); // Remove the column
        });
    }
};
