<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class ModeloUsuario extends Model
{
    use HasApiTokens,Notifiable;
    protected $table='usuarios';
    protected $fillable=['nombre','correo','password','rol','verificado','url_imagen'];
    public $timestamps=false;

    public function comentario(){
        return $this->hasMany('App\ModeloComentario','id_usuario');
    }

    public function token(){
        return $this->hasOne('App\ModeloToken','tokenable_id');
    }
    public function articulo(){
        return $this->hasMany('App\ModeloArticulo','id_vendedor');
    }

    public function getAuthIdentifier(){
        return $this->getKey();
    }
}
