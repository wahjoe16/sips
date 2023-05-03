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
        Schema::create('dosen', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 10);
            $table->string('nama', 100);
            $table->string('password');
            $table->string('email');
            $table->string('jabatan', 50)->nullable();
            $table->string('telepon', 17)->nullable();
            $table->integer('kelompok_studi_id')->nullable()->index();
            $table->enum('program_studi', [
                'Teknik Pertambangan',
                'Perencanaan Wilayah dan Kota',
                'Teknik Industri'
            ]);
            $table->enum('tipe', ['internal', 'eksternal'])->default('internal');
            $table->string('foto', 50);
            $table->tinyInteger('status_koordinator');
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
        Schema::dropIfExists('dosen');
    }
};
