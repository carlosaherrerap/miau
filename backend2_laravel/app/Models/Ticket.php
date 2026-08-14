<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table='ticket';

    protected $fillable = [
        'cod_ticket',
        'id_usuario',
        'fecha_emision',
        'id_categoria',
        'descripcion_problema',
        'nivel_importancia'
    ];

    protected $casts=[
        'id_emisor'=>'integer',
        'id_receptor'=>'integer',
        'fecha_emision'=>'datetime',
        'id_categoria'=>'integer'
    ];

    public $timestamps = false;

    public function fk_usuario(){
        return $this->belongsTo(Usuario::class,'id_usuario','id');
    }

    public function fk_categoria(){
        return $this->belongsTo(Categoria::class, 'id_categoria','id');
    }

    public function estado_ticket(){
        return $this->hasOne(Estadot::class,'id_ticket','id');
    }
}
