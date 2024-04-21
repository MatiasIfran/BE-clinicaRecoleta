<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pacientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre')->nullable(false);
            $table->string('Direccion', 100)->nullable();
            $table->string('CodPos', 5)->nullable();
            $table->string('dirpart', 50)->nullable();
            $table->string('zona', 2)->nullable();
            $table->unsignedBigInteger('NumDocumento')->nullable();
            $table->string('Telefono', 100)->nullable();
            $table->string('Celular', 100)->nullable();
            $table->date('FechaNacimiento')->nullable();
            $table->integer('edad')->nullable();
            $table->date('FechaIngreso')->nullable();
            $table->date('FechaCarga')->nullable();
            $table->string('NumAfiliado')->nullable();
            $table->string('Empres')->nullable();
            $table->string('Observ')->nullable();
            $table->string('prexist')->nullable();
            $table->string('Iva')->nullable();
            $table->string('Cuit')->nullable();
            $table->integer('Cabecera')->nullable();
            $table->unsignedBigInteger('TipoDocumento')->nullable()->default('1');
            $table->string('DetaPlan')->nullable();
            $table->string('Plan')->nullable();
            $table->string('Antecedentes')->nullable();
            $table->string('Plan2')->nullable();
            $table->string('Modulo')->nullable();
            $table->string('MedCabecera', 100)->nullable();
            $table->string('Mail', 100)->nullable();
            $table->string('hc')->nullable();
            $table->string('Genero', 10)->nullable();
            $table->timestamp('created_at')->default(now());            
            $table->timestamp('updated_at')->useCurrent();
            $table->string('usuario', 50)->nullable(false)->default('admin');
            $table->foreign('Cabecera')->references('Codigo')->on('profesionales');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pacientes');
    }
}