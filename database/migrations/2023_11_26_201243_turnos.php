<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Turnos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('turnos')) {
            Schema::create('turnos', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('paciente_id')->nullable();
                $table->integer('prof_cod')->nullable(false);
                $table->date("fecha")->nullable(false);
                $table->string('hora', 5)->nullable(false);
                $table->string('observ')->nullable();
                $table->tinyInteger('atendido')->nullable();
                $table->tinyInteger('presente')->nullable();
                $table->tinyInteger('primeraVisita')->nullable();
                $table->unsignedBigInteger('obra_social')->nullable();
                $table->timestamp('updated_at')->useCurrent();
                $table->timestamp('created_at')->default(now());            
                $table->string('usuario', 50)->nullable(false);
                $table->unique(['fecha', 'hora', 'paciente_id']);
                $table->unique(['prof_cod', 'fecha', 'hora']);
                $table->foreign('prof_cod')->references('Codigo')->on('profesionales');
                $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('turnos');
    }
}
