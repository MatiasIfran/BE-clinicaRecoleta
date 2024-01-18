
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Profesionales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profesionales', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre', 50)->nullable(false);
            $table->string('Apellido', 50)->nullable(false);
            $table->date('FechaNacimiento')->nullable();
            $table->string('Genero', 10)->nullable();
            $table->string('Direccion', 100)->nullable();
            $table->string('Telefono', 15)->nullable();
            $table->string('Mail', 100)->nullable();
            $table->unsignedBigInteger('TipoDocumento')->nullable(false);
            $table->unsignedBigInteger('NumDocumento')->nullable(false)->unique();
            $table->unsignedBigInteger('Matricula')->nullable();
            $table->unsignedBigInteger('Categoria')->nullable();
            $table->unsignedBigInteger('Cuit')->nullable();
            $table->integer('Codigo')->nullable(false)->unique();
            $table->boolean("daTurnos")->nullable()->default(true);
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
        Schema::dropIfExists('profesionales');
    }
}