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
                $table->unsignedBigInteger('id_paciente')->nullable();
                $table->integer('prof_cod')->nullable();
                $table->integer('tipoDiag')->nullable();
                $table->integer('tipoVisita')->nullable();
                $table->string('diag')->nullable();
                $table->string('trata')->nullable();
                $table->string('observ')->nullable();
                $table->string('link_imagen')->nullable();
                $table->date('fecha')->nullable();
                $table->string('registro')->nullable();
                $table->string('estudio')->nullable();
                $table->timestamp('updated_at')->useCurrent();
                $table->timestamp('created_at')->default(now()); 
                $table->string('usuario', 50)->nullable(false)->default('admin');
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
