<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => 'Telecomunicaciones', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Radios', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Antenas', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Reconocimiento Facial', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Huellero', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Alarmas', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Control de Acceso', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cámaras de Seguridad', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sensores de Movimiento', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Redes Inalámbricas', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
