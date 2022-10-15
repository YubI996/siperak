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
            $table->foreignId('rt_id')->onUpdate('cascade');
            $table->foreignId('ketua')->constrained('users')->onUpdate('cascade');
            // $table->foreignId('user_id')->onDelete('cascade');
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
        Schema::dropIfExists('pokmases');
    }
};
