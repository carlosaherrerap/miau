<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table='rol';

    protected $fillable = [
        'cod',   
        'nombre'
    ];

    public $timestamps = false;

    public function asignacion(){
        return $this->hasOne(Asignacion::class,'id_rol','id');
    }

}
