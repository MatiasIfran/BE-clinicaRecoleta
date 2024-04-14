<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Historiasclinicas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('historias_clinicas')) {
            Schema::create('historias_clinicas', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('id_paciente')->nullable(false);
                $table->integer('prof_cod')->nullable(false);
                $table->string('trata')->nullable();
                $table->string('observ')->nullable();
                $table->string('link_imagen')->nullable();
                $table->date('fecha')->nullable();
                $table->timestamp('updated_at')->useCurrent();
                $table->timestamp('created_at')->default(now()); 
                $table->string('usuario', 50)->nullable(false)->default('admin');
                $table->foreign('id_paciente')->references('id')->on('pacientes');
                $table->foreign('prof_cod')->references('Codigo')->on('profesionales');
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
        Schema::dropIfExists('historias_clinicas');
    }
}