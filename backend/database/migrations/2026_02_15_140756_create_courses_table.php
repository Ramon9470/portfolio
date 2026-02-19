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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('instituicao');
            $table->string('tipo');
            $table->string('status');
            $table->integer('horas')->nullable();
            $table->date('data_inicio')->nullable();
            $table->date('data_conclusao')->nullable();
            $table->string('certificado_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
