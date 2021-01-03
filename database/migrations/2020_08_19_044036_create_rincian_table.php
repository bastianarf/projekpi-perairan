<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRincianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rincian', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sppd_id');
            $table->text('kegunaan_biaya',255)->nullable();
            $table->bigInteger('jumlah_per_hari')->nullable();
            $table->date('tanggal_penggunaan');
            $table->date('tanggal_selesai');
            $table->text('keterangan');
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
        Schema::dropIfExists('rincian');
    }
}
