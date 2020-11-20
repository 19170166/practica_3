<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModeloComentario extends Model
{
    protected $table='comentarios';
    protected $fillable=['comentario','id_producto','id_usuario'];
    public $timestamps=false;

    public function producto(){
        return $this->hasOne('App\ModeloProducto','id');
    }
    public function usuario(){
        return $this->hasOne('App\ModeloUsuario','id');
    }
}
