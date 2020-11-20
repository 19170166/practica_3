<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\ModeloUsuario::class, function (Faker $faker) {
    return [
        'nombre'=>$faker->name(),
        'correo'=>$faker->unique()->safeEmail(),
        'password'=>Hash::make("12345678"),
        'rol'=>Arr::random(['user','vendedor']),
        'verificado'=>false,
        'url_imagen'=>null
    ];
});
