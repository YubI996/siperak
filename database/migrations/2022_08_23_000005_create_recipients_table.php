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
        Schema::create('recipients', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('nama',100);
            $table->string('nik',16)->nullable();
            $table->date('bd')->nullable();
            $table->string('foto_penerima')->nullable();
            $table->string('no_hp',16)->nullable();
            $table->enum('jenkel',['Laki-laki', 'Perempuan']);
            $table->string('alamat',200);
            $table->string('pekerjaan',20)->default('Tidak Bekerja');
            $table->string('penyakit',500)->nullable();
            $table->unsignedBigInteger('rt')->nullable();
            $table->string('foto_ktp')->nullable();
            $table->string('foto_kk')->nullable();
            $table->string('foto_rumah')->nullable();
            $table->enum('status_rumah',['Milik Sendiri', 'Mengontrak/Menyewa', 'Menumpang'])->nullable();
            $table->double('long', 12, 9)->nullable();
            $table->double('lat', 12, 9)->nullable();
            $table->timestamps();
            $table->foreign('rt')->references('id')->on('rts')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipients');
    }
};
