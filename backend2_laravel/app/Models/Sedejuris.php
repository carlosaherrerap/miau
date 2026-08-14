<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sedejuris extends Model
{
    protected $table='sede_juris';

    protected $fillable = [
        'id_sedereg',
        'nombre'
    ];

    protected $casts = [
        'id_sedereg'=>'integer'
    ];

    public $timestamps = false;

    public function fk_sede_reg(){
        return $this->belongsTo(Sedereg::class,'id_sedereg','id');
    }

    public function asignacion(){
        return $this->hasOne(Asignacion::class,'id_sedejuris','id');
    }

}
