<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sedereg extends Model
{
    protected $table='sede_reg';

    protected $fillable = [
        'nombre'
    ];

    public $timestamps = false;

    public function sedejuris(){
        return $this->hasMany(Sedejuris::class,'id_sedereg','id');
    }

    public function asignacion(){
        return $this->hasOne(Asignacion::class,'id_sedereg','id');
    }
}
