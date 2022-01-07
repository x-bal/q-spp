<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddActiveToYayasansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('yayasans', function (Blueprint $table) {
            $table->integer('is_active')->after('logo')->default(1);
            $table->integer('is_use')->after('is_active')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('yayasans', function (Blueprint $table) {
            $table->dropColumn('is_active');
            $table->dropColumn('is_use');
        });
    }
}
