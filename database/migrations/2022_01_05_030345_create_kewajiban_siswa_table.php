<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKewajibanSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kewajiban_siswa', function (Blueprint $table) {
            $table->foreignId('kewajiban_id');
            $table->foreignId('siswa_id');
            $table->double('nominal')->nullable();
            $table->date('tgl_bayar')->nullable();
            $table->string('status')->default('Belum Lunas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kewajiban_siswa');
    }
}
