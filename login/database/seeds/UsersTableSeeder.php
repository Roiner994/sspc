<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuarios = [
        	[
        		'nombre' => 'prueba2',
        		'apellido' => 'Hernandez',
        		'cedula' => '123',
        		'email' => 'prueba2@gmail.com',
        		'password' => bcrypt('54321'),
        		'tipo' => 'administrador',
        	]
        ];

        foreach ($usuarios as $usuario) {
			\App\Models\Usuario::create($usuario);        	
        }
    }

}
