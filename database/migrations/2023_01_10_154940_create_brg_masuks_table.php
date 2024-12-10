<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brg_masuks', function (Blueprint $table) {
            $table->id();
            $table->integer('jumlah_masuk');
            $table->integer('total_harga');
            $table->date('tgl_masuk');
            $table->unsignedBigInteger('id_barangs');
            $table->foreign('id_barangs')->references('id')->on('barangs');
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
        Schema::dropIfExists('brg_masuks');
    }
};
