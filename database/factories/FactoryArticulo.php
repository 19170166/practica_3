<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\ModeloUsuario;
use Faker\Generator as Faker;

$factory->define(App\ModeloArticulo::class, function (Faker $faker) {
    return [
        'nombre_articulo'=>$faker->sentence(2),
        'id_vendedor'=>App\ModeloUsuario::where('rol','vendedor')->get('id')->random()
    ];
});
