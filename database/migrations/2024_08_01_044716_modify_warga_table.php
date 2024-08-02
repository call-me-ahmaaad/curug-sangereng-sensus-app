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
        Schema::table('warga', function (Blueprint $table) {
            // Add the new column for tahun_data
            $table->string('tahun_data')->after('nama');

            // Drop the existing primary key on nik
            $table->dropPrimary(['nik']);

            // Add a composite primary key
            $table->primary(['nik', 'tahun_data']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('warga', function (Blueprint $table) {
            // Drop the composite primary key
            $table->dropPrimary(['nik', 'tahun_data']);

            // Drop the tahun_data column
            $table->dropColumn('tahun_data');

            // Add the primary key back to nik
            $table->primary('nik');
        });
    }
};
