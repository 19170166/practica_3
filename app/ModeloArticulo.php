<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModeloArticulo extends Model
{
    protected $table='articulos';
    protected $fillable=['nombre_articulo','id_vendedor'];
    public $timestamps=false;

    public function comentario(){
        $this->hasMany('App\ModeloComentarios','id_producto');
    }
    public function usuario(){
        $this->hasOne('App\ModeloUsuario','id');
    }
}
