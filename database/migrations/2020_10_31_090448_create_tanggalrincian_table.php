<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTanggalrincianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tanggalrincian', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sppd_id');
            $table->text('tgltelahmenerima')->nullable();
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
        Schema::dropIfExists('tanggalrincian');
    }
}
