<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);

         DB::table('users')->insert([
            [
            'name'      =>  'administrador', 
            'email'     =>  'admin@admin.com', 
            'password'  =>  bcrypt('admin123'),
            'type'		=>	'Administrador'
            ]
    	]);
    }
}
