<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTglSuratKwitansisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tgl_surat_kwitansis', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('sppd_id');
            $table->date('tanggal_surat_kwitansi')->nullable();
            $table->string('tempat_surat_kwitansi',255)->nullable();
            $table->foreign('sppd_id')->references('id')->on('sppd')->onDelete('CASCADE');
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
        Schema::dropIfExists('tgl_surat_kwitansis');
    }
}
