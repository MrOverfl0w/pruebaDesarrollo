<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    //
    protected $primaryKey = 'identificacion';
    public $incrementing = false;
    protected $keyType = 'string';

    public function vehiculos(){
        return $this->belongsToMany('App\Vehiculo','historial_vehiculos','idpersona','vehiculo')
            ->withPivot('activo','created_at','updated_at')->withTimeStamps();
    }
}
