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
        Schema::create('tempat_lahir', function (Blueprint $table) {
            $table->id();
            $table->string('tempat_lahir');
            $table->timestamps();
        });

        Schema::create('warga', function (Blueprint $table) {
            $table->string('nik')->primary();
            $table->string('no_akta_lahir')->unique();
            $table->string('no_kk');
            $table->foreign('no_kk')->references('no_kk')->on('keluarga');
            $table->string('nama');
            $table->boolean('punya_ktp');
            $table->string('status_jkn');
            $table->unsignedBigInteger('id_tempat_lahir');
            $table->foreign('id_tempat_lahir')->references('id')->on('tempat_lahir');
            $table->string('tanggal_lahir');
            $table->string('jenis_kelamin');
            $table->string('agama');
            $table->string('golongan_darah');
            $table->string('pendidikan');
            $table->string('pekerjaan');
            $table->string('status_nikah');
            $table->string('status_keluarga');
            $table->string('kewarganegaraan');
            $table->string('nama_ibu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warga');
        Schema::dropIfExists('tempat_lahir');
    }
};
