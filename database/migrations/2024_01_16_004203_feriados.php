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
                $table->date('fecha')->nullable(false);
                $table->integer('prof_cod')->nullable();
                $table->string('titulo')->nullable(false);
                $table->string('motivo')->nullable();
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
        Schema::dropIfExists('feriados');
    }
}
