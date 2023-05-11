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
            $table->bigInteger('mahasiswa_id')->unsigned();
            $table->bigInteger('tahun_ajaran_id')->unsigned();
            $table->bigInteger('dosen1_id')->unsigned();
            $table->bigInteger('dosen2_id')->unsigned();
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
            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('tahun_ajaran_id')->references('id')->on('tahun_ajaran')->onDelete('cascade');
            $table->foreign('dosen1_id')->references('id')->on('dosens')->onDelete('cascade');
            $table->foreign('dosen2_id')->references('id')->on('dosens')->onDelete('cascade');
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
