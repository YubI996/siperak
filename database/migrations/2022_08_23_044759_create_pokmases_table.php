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
        Schema::create('pokmases', function (Blueprint $table) {
            $table->id();
            $table->string('nama',30)->comment('Nama pokmas')->default('pokmas');
            $table->string('alamat')->nullable();
            $table->integer('rt')->unsigned();
            $table->integer('ketua')->unsigned();
            $table->timestamps();
            $table->foreign('rt')->references('id')->on('rts')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('ketua')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pokmases');
    }
};
