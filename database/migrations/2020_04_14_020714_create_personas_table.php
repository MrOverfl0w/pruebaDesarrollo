<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->string('identificacion', 50)->primary();
            $table->string('nombre', 50);
            $table->string('apellidos', 100);
            $table->date('nacimiento');
            $table->string('profesion', 50);
            $table->boolean('casado');
            $table->double('ingresos', 50, 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personas');
    }
}
