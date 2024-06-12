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
        Schema::create('pembelians', function (Blueprint $table) {
            $table->id();
            $table->string('faktur');
            $table->date('tanggal_faktur');
            $table->integer('supplier');
            $table->date('jatuh_tempo');
            $table->float('ppn')->nullable();
            $table->float('diskon_persen')->nullable();
            $table->double('diskon_rupiah')->nullable();
            $table->double('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelians');
    }
};
