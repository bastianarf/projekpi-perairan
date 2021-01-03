<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTanggalkwitansiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tanggalkwitansi', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sppd_id');
            $table->text('tglyangmenerima')->nullable();
            $table->text('tglbendahara')->nullable();
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
        Schema::dropIfExists('tanggalkwitansi');
    }
}
