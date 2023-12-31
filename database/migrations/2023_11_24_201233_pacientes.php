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
            $table->string('Nombre', 50)->nullable(false);
            $table->string('Apellido', 50)->nullable(false);
            $table->date('FechaNacimiento')->nullable();
            $table->string('Genero', 10)->nullable();
            $table->string('Direccion', 100)->nullable();
            $table->string('CodPos', 5)->nullable();
            $table->string('Telefono', 15)->nullable();
            $table->string('Mail', 100)->nullable();
            $table->unsignedBigInteger('TipoDocumento')->nullable(false);
            $table->unsignedBigInteger('NumDocumento')->nullable(false)->unique();
            $table->unsignedBigInteger('Cuit')->nullable();
            $table->unsignedBigInteger('NumAfiliado')->nullable();
            $table->unsignedBigInteger('Empres')->nullable();
            $table->unsignedBigInteger('DetaPlan')->nullable();
            $table->unsignedBigInteger('Plan')->nullable();
            $table->unsignedBigInteger('Antecedentes')->nullable();
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