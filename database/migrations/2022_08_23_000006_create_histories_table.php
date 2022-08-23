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
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->integer('reception')->unsigned()->nullable();
            $table->enum('status_trima',['Diajukan', 'Menerima', 'Menolak', 'Pindah', 'Meninggal'])->default('Diajukan');
            $table->string('alasan')->default('-')->nullable();
            $table->timestamps();
            $table->foreign('reception')->references('id')->on('receptions')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('histories');
    }
};
