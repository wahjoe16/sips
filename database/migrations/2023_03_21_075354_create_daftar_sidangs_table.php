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
        Schema::create('daftar_sidang', function (Blueprint $table) {
            $table->id();
            $table->integer('mahasiswa_id');
            $table->integer('tahun_ajaran_id');
            $table->integer('dosen1_id');
            $table->integer('dosen2_id');
            $table->text('judul_skripsi');
            $table->dateTime('tanggal_pengajuan');
            $table->string('syarat_1');
            $table->string('syarat_2');
            $table->string('syarat_3');
            $table->string('syarat_4');
            $table->string('syarat_5');
            $table->string('syarat_6');
            $table->string('syarat_7');
            $table->string('syarat_8');
            $table->string('syarat_9');
            $table->string('syarat_10');
            $table->string('syarat_11');
            $table->string('syarat_12');
            $table->string('syarat_13');
            $table->string('syarat_14');
            $table->string('syarat_15');
            $table->string('syarat_16');
            $table->string('syarat_17');
            $table->string('syarat_18');
            $table->string('syarat_19');
            $table->string('syarat_20');
            $table->tinyInteger('status');
            $table->text('keterangan');
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
        Schema::dropIfExists('daftar_sidang');
    }
};
