<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre', 50);
            $table->string('Apellido', 50);
            $table->date('FechaNacimiento')->nullable();
            $table->string('Genero', 10)->nullable();
            $table->string('Direccion', 100)->nullable();
            $table->string('Telefono', 15)->nullable();
            $table->string('Mail', 100)->nullable();
            $table->string('Sexo', 10)->nullable();
            $table->integer('NumDocumento')->nullable();
            $table->timestamp('updated_at')->default(now());
            $table->timestamp('created_at')->default(now());
            $table->string('usuario', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personas');
    }
}
