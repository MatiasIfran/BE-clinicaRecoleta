<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoDocumentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipoDocumento', function (Blueprint $table) {
            $table->id('idTipoDocumento');
            $table->string('descripcion', 50)->nullable(false);
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('created_at')->default(now());
            $table->string('usuario', 50)->nullable(false);
        });

        //Insercion de datos
        DB::table('tipoDocumento')->insert([
            ['descripcion' => 'DNI', 'usuario' => 'admin'],
            ['descripcion' => 'Libreta cívica', 'usuario' => 'admin'],
            ['descripcion' => 'Libreta de Enrolamiento', 'usuario' => 'admin'],
            ['descripcion' => 'Pasaporte', 'usuario' => 'admin'],

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipoDocumento');
    }
}
