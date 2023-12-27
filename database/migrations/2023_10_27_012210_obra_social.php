<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ObraSocial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obra_social', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->nullable(false)->unique();
            $table->string('descripcion');
            $table->string('codArancel', 20);
            $table->boolean('activa')->default(true);
            $table->decimal('valor', 10, 2);
            $table->integer('maxAnual')->default(0);
            $table->integer('maxMensual')->default(0);
            $table->string('obraSocial');
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('created_at')->default(now());
            $table->string('usuario', 50)->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('obra_social');
    }
}
