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
                $table->integer('prof_cod')->nullable(false);
                $table->string('dia')->nullable();
                $table->string('desde', 5)->default('');
                $table->string('hasta', 5)->default('');
                $table->unsignedTinyInteger('tiempo')->default(0);
                $table->timestamp('updated_at')->useCurrent();
                $table->timestamp('created_at')->default(now());            
                $table->string('usuario', 50)->nullable(false);
                $table->foreign('prof_cod')->references('Codigo')->on('profesionales');
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
        Schema::dropIfExists('horarios');
    }
}
