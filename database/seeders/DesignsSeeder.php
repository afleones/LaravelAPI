<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DesignsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('designs')->insert([
            ['name' => 'Clásico', 'state' => 1],
            ['name' => 'Moderno', 'state' => 1],
            ['name' => 'Vintage', 'state' => 1],
            ['name' => 'Floral', 'state' => 1],
            ['name' => 'Minimalista', 'state' => 1],
            ['name' => 'Temático', 'state' => 1],
            ['name' => 'Gótico', 'state' => 1],
            ['name' => 'Nupcial', 'state' => 1],
            ['name' => 'De Cumpleaños', 'state' => 1],
            ['name' => 'Navideño', 'state' => 1],
        ]);
    }
}
