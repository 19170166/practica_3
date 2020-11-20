<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModeloToken extends Model
{
    protected $table='personal_access_tokens';
    protected $fillable=['abilities','name'];
    
    public function usuario(){
        return $this->hasOne('App\ModeloUsuario','id');
    }
}
