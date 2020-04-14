<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historial_vehiculos', function (Blueprint $table) {
            $table->id();
            $table->string('idpersona', 50);
            $table->string('vehiculo', 6);
            $table->boolean('activo')->default(1);
            $table->timestamps();
            
            $table->foreign('idpersona')->references('identificacion')->on('personas');
            $table->foreign('vehiculo')->references('placa')->on('vehiculos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historial_vehiculos');
    }
}
