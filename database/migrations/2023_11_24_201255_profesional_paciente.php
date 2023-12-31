<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProfesionalPaciente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profesional_paciente', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('profesional_id');
            $table->unsignedBigInteger('paciente_id');
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('created_at')->default(now());            
            $table->string('usuario', 50)->nullable(false);
            $table->foreign('profesional_id')->references('id')->on('profesionales')->onDelete('cascade');
            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profesional_paciente');
    }
}