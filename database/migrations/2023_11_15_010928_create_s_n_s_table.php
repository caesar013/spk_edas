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
        Schema::create('s_n_s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_alternative');
            $table->foreign('id_alternative')->references('id')->on('alternatives')->onDelete('cascade');
            $table->decimal('value', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('s_n_s');
    }
};
