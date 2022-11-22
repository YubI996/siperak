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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penerima');
            $table->unsignedBigInteger('menu');
            $table->unsignedBigInteger('pengantar');
            $table->string('keterangan', 200)->nullable();
            $table->string('pengaduan',300)->comment('kondisi lansia');
            $table->string('dok',100)->comment('foto dokumentasi')->nullable();
            $table->enum('karbo_consmd',['0','0.25','0.50','0.75','1'])->comment('rasio dimakan')->default('1');
            $table->enum('l_hwn_consmd',['0','0.25','0.50','0.75','1'])->comment('rasio dimakan')->default('1');
            $table->enum('l_nbt_consmd',['0','0.25','0.50','0.75','1'])->comment('rasio dimakan')->default('1');
            $table->enum('sayur_consmd',['0','0.25','0.50','0.75','1'])->comment('rasio dimakan')->default('1');
            $table->enum('buah_consmd',['0','0.25','0.50','0.75','1'])->comment('rasio dimakan')->default('1');
            $table->timestamps();
            $table->foreign('penerima')->references('id')->on('recipients')->onUpdate('cascade');
            $table->foreign('menu')->references('id')->on('menus')->onUpdate('cascade');
            $table->foreign('pengantar')->references('id')->on('users')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deliveries');
    }
};
