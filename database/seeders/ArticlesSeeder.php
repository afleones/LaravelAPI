<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('articles')->insert([
            ['name' => 'Boda', 'description' => 'Para bodas', 'state' => 1, 'created_at'=> now(), 'updated_at'=> now()],
            ['name' => 'Bautizo', 'description' => 'Para bautizos', 'state' => 1, 'created_at'=> now(), 'updated_at'=> now()],
            ['name' => 'Revelación de sexo', 'description' => 'Para revelaciones', 'state' => 1, 'created_at'=> now(), 'updated_at'=> now()],
            ['name' => 'Baby shower', 'description' => 'Para baby showers', 'state' => 1, 'created_at'=> now(), 'updated_at'=> now()],
            ['name' => 'Grado', 'description' => 'Para grados', 'state' => 1, 'created_at'=> now(), 'updated_at'=> now()],
            ['name' => 'Quince años', 'description' => 'Para quince años', 'state' => 1, 'created_at'=> now(), 'updated_at'=> now()],
            ['name' => 'Futbol', 'description' => 'Tema futbol', 'state' => 1, 'created_at'=> now(), 'updated_at'=> now()],
            ['name' => 'Super Mario', 'description' => 'Tema Super Mario', 'state' => 1, 'created_at'=> now(), 'updated_at'=> now()],
            ['name' => 'Princesas', 'description' => 'Tema princesas', 'state' => 1, 'created_at'=> now(), 'updated_at'=> now()],
            ['name' => 'La granja', 'description' => 'Tema granja', 'state' => 1, 'created_at'=> now(), 'updated_at'=> now()],
            ['name' => 'Barbie', 'description' => 'Tema Barbie', 'state' => 1, 'created_at'=> now(), 'updated_at'=> now()],
        ]);
    }
}
