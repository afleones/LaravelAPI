<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('forms')->insert([
            ['name' => 'Cilíndro', 'state' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cuadrado', 'state' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Redonda', 'state' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Corazón', 'state' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Triangulo', 'state' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
