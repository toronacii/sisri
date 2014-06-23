<?php

class UsuarioTableSeeder extends Seeder {
 
    public function run()
    {
    	DB::table('usuarios')->truncate();

        $users = [
            ['username' => 'toronacii', 'password' => Hash::make('123'), 'publicadores_id' => 1],
        ];
 
        DB::table('usuarios')->insert($users);
    }
 
}