<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaSppTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa_spp', function (Blueprint $table) {
            $table->foreignId('siswa_id');
            $table->foreignId('spp_id');
            $table->double('nominal')->default(0);
            $table->dateTime('tanggal_bayar')->nullable();
            $table->string('status')->default('Belum Bayar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswa_spp');
    }
}
