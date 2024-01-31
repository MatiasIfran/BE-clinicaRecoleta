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
            $table->string('Apellido')->nullable(false);
            $table->string('Direccion', 100)->nullable();
            $table->string('CodPos', 5)->nullable();
            $table->unsignedBigInteger('TipoDocumento')->nullable(false)->default('0000');
            $table->unsignedBigInteger('NumDocumento')->nullable(false)->unique();
            $table->string('Telefono', 100)->nullable();
            $table->date('FechaNacimiento')->nullable();
            $table->date('FechaIngreso')->nullable();
            $table->date('FechaCarga')->nullable();
            $table->string('NumAfiliado')->nullable();
            $table->string('Empres')->nullable();
            $table->string('Antecedentes')->nullable();
            $table->string('Iva')->nullable();
            $table->string('Cuit')->nullable();
            $table->unsignedBigInteger('DetaPlan')->nullable();
            $table->string('Plan')->nullable();
            $table->string('Mail', 100)->nullable();
            $table->string('Genero', 10)->nullable();
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('created_at')->default(now());            
            $table->string('usuario', 50)->nullable(false);
            $table->foreign('TipoDocumento')->references('idTipoDocumento')->on('tipoDocumento');
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