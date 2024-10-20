<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('operasional', function (Blueprint $table) {
            $table->id();
            $table->date("tanggal");
            $table->integer("id_akun");
            $table->string("tujuan", 100);
            $table->integer("jumlah");
            $table->enum("tipe", ['kredit', 'debit']);
            $table->integer("kas_masuk")->default(0);
            $table->integer("kas_keluar")->default(0);
            $table->integer("saldo");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operasional');
    }
};
