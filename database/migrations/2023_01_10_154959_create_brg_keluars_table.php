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
        Schema::create('brg_keluars', function (Blueprint $table) {
            $table->id();
            $table->integer('jumlah_keluar');
            $table->integer('total_harga');
            $table->date('tgl_keluar');
            $table->unsignedBigInteger('id_barangs');
            $table->unsignedBigInteger('id_customers');
            $table->timestamps();
            $table->foreign('id_barangs')->references('id')->on('barangs');
            $table->foreign('id_customers')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brg_keluars');
    }
};
