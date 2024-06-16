<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'admin',
                'email' => 'admin@lionstech.co',
                'email_verified_at' => null,
                'password' => Hash::make('12345678'), // Aquí deberías usar el hash correcto de la contraseña
                'remember_token' => null,
                'created_at' => '2024-05-31 13:46:48',
                'updated_at' => '2024-06-16 19:11:37',
            ],
            [
                'id' => 2,
                'name' => 'customer',
                'email' => 'customer@lionstech.co',
                'email_verified_at' => null,
                'password' => Hash::make('12345678'), // Aquí deberías usar el hash correcto de la contraseña
                'remember_token' => null,
                'created_at' => '2024-05-31 13:46:48',
                'updated_at' => '2024-05-31 13:46:48',
            ],
        ]);
    }
}
