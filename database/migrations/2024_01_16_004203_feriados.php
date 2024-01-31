<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Feriados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('feriados')) {
            Schema::create('feriados', function (Blueprint $table) {
                $table->id();
                $table->date('fecha')->nullable(false)->unique();
                $table->integer('prof_cod')->nullable();
                $table->string('titulo')->nullable(false);
                $table->string('motivo')->nullable();
                $table->timestamps();
                $table->string('usuario', 50)->nullable(false);
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
        Schema::dropIfExists('feriados');
    }
}
