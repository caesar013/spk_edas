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
        Schema::create('n_d_a_s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_edas');
            $table->foreign('id_edas')->references('id')->on('edas')->onDelete('cascade');
            $table->unsignedBigInteger('id_criteria');
            $table->foreign('id_criteria')->references('id')->on('criterias')->onDelete('cascade');
            $table->unsignedBigInteger('id_alternative');
            $table->foreign('id_alternative')->references('id')->on('alternatives')->onDelete('cascade');
            $table->decimal('value', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('n_d_a_s');
    }
};
