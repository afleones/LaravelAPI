<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('categories')->insert([
            ['name' => 'Pasteles', 'description' => null, 'state' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cupcakes', 'description' => null, 'state' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Galletas', 'description' => null, 'state' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Shots de postres', 'description' => null, 'state' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cakepops', 'description' => null, 'state' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Paletas tipo magnum', 'description' => null, 'state' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Brownies', 'description' => null, 'state' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Otros', 'description' => null, 'state' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
