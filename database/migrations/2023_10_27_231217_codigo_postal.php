<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CodigoPostal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codpos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 5)->nullable(false)->unique();
            $table->string('descripcion', 50)->nullable();
            $table->timestamp('updated_at')->default(now());
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
        //
    }
}
