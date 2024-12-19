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
    Schema::create('payments', function (Blueprint $table) {
        $table->id();
        $table->string('student_name'); // Nama pelajar
        $table->string('kelas'); // Kelas pelajar
        $table->string('package_code'); // Kode paket
        $table->string('package_name'); // Nama paket
        $table->string('payment_status')->default('Pending'); // Status pembayaran
        $table->string('payment_proof')->nullable(); // Bukti pembayaran
        $table->timestamps(); // Tanggal dibuat dan diperbarui
    });
}

public function down()
{
    Schema::dropIfExists('payments');
}

};
