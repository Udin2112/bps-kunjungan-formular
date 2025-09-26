<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('feedback', function (Blueprint $table) {
            $table->string('pekerjaan')->nullable()->change();
            $table->string('instansi')->nullable()->change();
            $table->string('layanan')->nullable()->change();
            $table->string('kunjungan')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('feedback', function (Blueprint $table) {
            $table->string('pekerjaan')->nullable(false)->change();
            $table->string('instansi')->nullable(false)->change();
            $table->string('layanan')->nullable(false)->change();
            $table->string('kunjungan')->nullable(false)->change();
        });
    }
};
