<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    protected $table='publicacion';

    protected $fillable = [
        'nombre',
        'version',
        'fecha_publicacion',
        'fecha_vigencia',
        'indicaciones'
    ];

    protected $casts = [
        'version'=>'decimal',
        'fecha_publicacion'=>'datetime',
        'fecha_vigencia'=>'datetime'
    ];

    public $timestamps = false;

    public function permisosp(){
        return $this->hasOne(Permisosp::class,'id_publicacion','id');
    }
    
    public function vista_publicacion(){
        return $this->hasOne(Vistap::class,'id_publicacion','id');
    }

}
