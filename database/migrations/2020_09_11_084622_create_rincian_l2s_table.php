<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRincianL2sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rincian_l2s', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('sppd_id');
            $table->string('berangkat_dari',255);
            $table->string('tiba_di', 255);
            $table->date('tanggal_berangkat');
            $table->date('tanggal_tiba');
            $table->string('kepala', 255);
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
        Schema::dropIfExists('rincian_l2s');
    }
}
