<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModeloProducto extends Model
{

    protected $table='productos';
    protected $fillable='nombre_producto';
    public $timestamps=false;

    public function comentario(){
        return $this->hasMany('App\ModeloComentario','id_producto');
    }
}
