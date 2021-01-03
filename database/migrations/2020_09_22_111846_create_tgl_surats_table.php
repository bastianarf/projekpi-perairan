<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTglSuratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tgl_surats', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('sppd_id');
            $table->date('tanggal_surat_rincian')->nullable();
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
        Schema::dropIfExists('tgl_surats');
    }
}
