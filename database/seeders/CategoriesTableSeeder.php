<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Radios'],
            ['name' => 'Antenas'],
            ['name' => 'Productos de Seguridad'],
            ['name' => 'Accesorios'],
            ['name' => 'Comunicaciones Satelitales'],
            ['name' => 'Sistemas de Monitoreo'],
            ['name' => 'Equipos de Emergencia'],
        ];

        DB::table('categories')->insert($categories);
    }
}
