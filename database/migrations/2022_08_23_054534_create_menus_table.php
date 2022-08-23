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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->integer('pokmas')->unsigned();
            $table->string('karbo')->nullable();
            $table->string('l_hewani')->nullable();
            $table->string('l_nabati')->nullable();
            $table->string('sayur')->nullable();
            $table->string('buah')->nullable();
            $table->enum('waktu',['Siang', 'Malam'])->nullable();
            $table->string('foto')->default('default.png');
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
        Schema::dropIfExists('menus');
    }
};
