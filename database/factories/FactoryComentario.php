<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\ModeloComentario;
use App\ModeloUsuario;
use App\ModeloArticulo;
use Faker\Generator as Faker;

$factory->define(App\ModeloComentario::class, function (Faker $faker) {
    return [
        'comentario'=>$faker->sentence(5),
        'id_producto'=>App\ModeloArticulo::get('id')->random(),
        'id_usuario'=>App\ModeloUsuario::where('rol','user')->get('id')->random()
    ];
});
