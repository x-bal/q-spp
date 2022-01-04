<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKewajibansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kewajibans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tahun_ajaran_id');
            $table->foreignId('sekolah_id');
            $table->string('nama');
            $table->double('biaya', 20);
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
        Schema::dropIfExists('kewajibans');
    }
}
