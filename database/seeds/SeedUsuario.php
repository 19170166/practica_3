<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class SeedUsuario extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('Usuarios')->insert([
            'nombre'=>'admin',
            'correo'=>'admin@gmail.com',
            'password'=>Hash::make("12345678"),
            'rol'=>'admin'
        ]);

        $use=factory(App\ModeloUsuario::class,15)->create();
    }
}
