<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FlavorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('flavors')->insert([
            ['name' => 'Vainilla', 'state' => 1, 'created_at'=> now(), 'updated_at'=> now()],
            ['name' => 'Banana', 'state' => 1, 'created_at'=> now(), 'updated_at'=> now()],
            ['name' => 'Chocolate', 'state' => 1, 'created_at'=> now(), 'updated_at'=> now()],
            ['name' => 'Naranja', 'state' => 1, 'created_at'=> now(), 'updated_at'=> now()],
            ['name' => 'Red Velvet', 'state' => 1, 'created_at'=> now(), 'updated_at'=> now()],
            ['name' => 'Zanahoria', 'state' => 1, 'created_at'=> now(), 'updated_at'=> now()],
        ]);
    }
}
