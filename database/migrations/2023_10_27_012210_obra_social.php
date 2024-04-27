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
            $table->string('codArancel', 20)->nullable();
            $table->boolean('activa')->default(true);
            $table->integer('orden')->nullable();
            $table->decimal('valor', 10, 2)->nullable();
            $table->integer('maxAnual')->default(0);
            $table->integer('maxMensual')->default(0);
            $table->string('obraSocial')->nullable();
            $table->date('vigencia')->nullable();
            $table->string('mensaje1')->nullable();
            $table->string('mensaje2')->nullable();
            $table->string('mensaje3')->nullable();
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('created_at')->default(now());
            $table->string('usuario', 50)->nullable(false)->default('admin');
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
