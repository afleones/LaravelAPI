<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Insertar roles con descripciones y estado por defecto
        DB::table('roles')->insert([
            [
                'name' => 'admin',
                'description' => 'Rol de administrador con acceso total.',
                'state' => 1, // 1 activo, 0 inactivo
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'customer',
                'description' => 'Rol de cliente, solo para comprar.',
                'state' => 1, // 1 activo, 0 inactivo
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
