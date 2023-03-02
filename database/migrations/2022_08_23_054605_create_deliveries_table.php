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
            $table->unsignedBigInteger('pengantar')->nullable();
            $table->enum('status', ['Belum diantar', 'Sudah diantar'])->nullable()->comment('status pengiriman')->default('Belum diantar');
            $table->string('pengaduan',300)->nullable()->comment('kondisi lansia');
            $table->string('dok',100)->comment('foto dokumentasi')->nullable();
            $table->enum('karbo_consmd',['0','0.25','0.50','0.75','1'])->comment('rasio dimakan')->default('1')->nullable();
            $table->enum('l_hwn_consmd',['0','0.25','0.50','0.75','1'])->comment('rasio dimakan')->default('1')->nullable();
            $table->enum('l_nbt_consmd',['0','0.25','0.50','0.75','1'])->comment('rasio dimakan')->default('1')->nullable();
            $table->enum('sayur_consmd',['0','0.25','0.50','0.75','1'])->comment('rasio dimakan')->default('1')->nullable();
            $table->enum('buah_consmd',['0','0.25','0.50','0.75','1'])->comment('rasio dimakan')->default('1')->nullable();
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
