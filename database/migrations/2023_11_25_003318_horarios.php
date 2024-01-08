<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Horarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('horarios')) {
            Schema::create('horarios', function (Blueprint $table) {
                $table->id();
                $table->string('profesional_id')->nullable(false);
                $table->date('dia')->nullable(false);
                $table->string('desde', 5)->default('');
                $table->string('hasta', 5)->default('');
                $table->unsignedTinyInteger('tiempo')->default(0);
                $table->timestamp('updated_at')->useCurrent();
                $table->timestamp('created_at')->default(now());            
                $table->string('usuario', 50)->nullable(false);
                $table->unique(['profesional_id', 'dia', 'desde', 'hasta', 'tiempo']);
                $table->foreign('profesional_id')->references('id')->on('profesionales')->onDelete('cascade');
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
        Schema::dropIfExists('horario');
    }
}
