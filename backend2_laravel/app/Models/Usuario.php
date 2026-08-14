<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table='usuario';

    protected $hidden = [
        'clave'
    ];

    protected $fillable = [
        'id_rol',
        'cod_usuario',
        'username',
        'clave',
        'nombres',
        'ape_pat',
        'ape_mat',
        'id_sedereg',
        'id_sedejuris',
        'doc',
        'email',
        'estado'
    ];

    protected $casts = [
        'id_rol'=>'integer',
        'id_sedereg'=>'integer',
        'id_sedejuris'=>'integer',
        'doc'=>'integer',
        'estado'=>'integer'
    ];

    public $timestamps = false;

    public function fk_rol(){
        return $this->belongsTo(Rol::class,'id_rol');
    }

    public function fk_sedereg(){
        return $this->belongsTo(Sedereg::class,'id_sedereg','id');
    }

    public function fk_sedejuris(){
        return $this->belongsTo(Sedejuris::class,'id_sedejuris','id');
    }

    public function asignacion(){
        return $this->hasOne(Asignacion::class,'id_usuario','id');
    }

    public function ticket(){
        return $this->hasOne(Ticket::class,'id_ticket','id');
    }

    public function vista_publicacion(){
        return $this->hasOne(Vistap::class,'id_usuario','id');
    }

}
