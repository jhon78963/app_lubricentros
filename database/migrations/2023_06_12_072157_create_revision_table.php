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
        Schema::create('revisiones', function (Blueprint $table) {
            $table->id();
            $table->string('placa');
            $table->boolean('motor');
            $table->string('motor_detail')->nullable();
            $table->boolean('frenos');
            $table->string('frenos_detail')->nullable();
            $table->boolean('suspension_direccion');
            $table->string('suspension_direccion_detail')->nullable();
            $table->boolean('luces_señalizacion');
            $table->string('luces_señalizacion_detail')->nullable();
            $table->boolean('equipo_seguridad');
            $table->string('equipo_seguridad_detail')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('revision');
    }
};
