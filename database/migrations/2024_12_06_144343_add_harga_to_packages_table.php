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
    Schema::table('packages', function (Blueprint $table) {
        $table->decimal('harga', 15, 2)->after('urutan_destinasi');
    });
}

public function down()
{
    Schema::table('packages', function (Blueprint $table) {
        $table->dropColumn('harga');
    });
}

};
