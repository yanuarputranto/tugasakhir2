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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('package_id'); // ID Paket yang dipilih
            $table->unsignedBigInteger('teacher_id'); // ID Pengajar yang membuat reservasi
            $table->date('reservation_date'); // Tanggal reservasi
            $table->integer('number_of_participants'); // Jumlah peserta
            $table->text('notes')->nullable(); // Catatan opsional
            $table->timestamps();

            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');
            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
