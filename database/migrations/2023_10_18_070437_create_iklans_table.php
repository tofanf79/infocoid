<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iklans', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi');
            $table->time('jam_buka');
            $table->time('jam_tutup');
            $table->string('hari_kerja');
            $table->string('provinsi');
            $table->string('kabupaten');
            $table->string('kecamatan');
            $table->string('desa');
            $table->string('alamat');
            $table->string('kode_pos');
            $table->string('nohp');
            $table->string('email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('iklans', function (Blueprint $table) {
            $table->dropColumn('gambar'); // Menghapus kolom 'gambar' saat rollback
        });

        Schema::dropIfExists('iklans');
    }
};
