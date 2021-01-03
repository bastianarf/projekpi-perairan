<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sppd_id');
            $table->text('petunjuk')->nullable();
            $table->text('masalah')->nullable();
            $table->text('saran')->nullable();
            $table->text('lain_lain')->nullable();
            $table->text('tglcetak')->nullable();
            $table->timestamps();
            $table->foreign('sppd_id')->references('id')->on('sppd')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporan');
    }
}
