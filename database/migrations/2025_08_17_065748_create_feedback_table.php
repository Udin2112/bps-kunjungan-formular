<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('alamat')->nullable(); // ✅ alamat tamu
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']); // ✅ jenis kelamin
            $table->integer('usia')->nullable(); // ✅ usia tamu
            $table->date('tanggal_kunjungan'); // ✅ untuk grafik per hari/bulan/tahun
            $table->string('pekerjaan');
            $table->string('instansi');
            $table->string('layanan');
            $table->string('kunjungan');
            $table->text('message');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
