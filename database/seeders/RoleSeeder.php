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
                'description' => 'Administrator role with full access.',
                'state' => 1, // 1 activo, 0 inactivo
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'customer',
                'description' => 'Customer role with limited access.',
                'state' => 1, // 1 activo, 0 inactivo
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
