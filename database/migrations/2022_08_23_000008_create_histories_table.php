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
            $table->foreignId('recipient')->constrained()->onUpdate('cascade');
            $table->enum('status_trima',['Diajukan', 'Menerima', 'Ditolak', 'Menolak', 'Pindah', 'Meninggal', 'Dihapus'])->default('Diajukan');
            $table->string('alasan')->default('-')->nullable();
            $table->foreignId('actor')->constrained('users')->onUpdate('cascade');
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
        Schema::dropIfExists('histories');
    }
};
