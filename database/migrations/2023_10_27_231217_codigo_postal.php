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
        if (!Schema::hasTable('codpos')) {
            Schema::create('codpos', function (Blueprint $table) {
                $table->id();
                $table->string('codigo', 5)->nullable(false)->unique();
                $table->string('ciudad', 50)->nullable();
                $table->string('provincia', 50)->nullable();
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
        Schema::dropIfExists('codpos');
    }
}
