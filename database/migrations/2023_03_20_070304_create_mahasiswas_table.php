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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->string('npm', 15);
            $table->string('nama', 150);
            $table->string('password');
            $table->enum('program_studi', [
                'Teknik Pertambangan',
                'Perencanaan Wilayah dan Kota',
                'Teknik Industri'
            ]);
            $table->integer('angkatan');
            $table->string('telepon', 15)->nullable();
            $table->string('email')->nullable();
            $table->string('foto')->nullable();
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
        Schema::dropIfExists('mahasiswa');
    }
};
