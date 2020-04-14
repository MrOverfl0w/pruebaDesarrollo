<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    //
    protected $primaryKey = 'placa';
    public $incrementing = false;
    protected $keyType = 'string';

    public function personas(){
        return $this->belongsToMany('App\Persona','historial_vehiculos','vehiculo','idpersona')
            ->withPivot('activo','created_at','updated_at')->withTimeStamps();
    }
}
