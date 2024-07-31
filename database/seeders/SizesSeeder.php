<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sizes')->insert([
            ['name' => '1/4 de Libra', 'price' => 30000, 'state' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => '1/2 Libra', 'price' => 50000, 'state' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => '12 Onzas', 'price' => 70000, 'state' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => '1 Libra', 'price' => 90000, 'state' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => '1 Libra y 1/2', 'price' => 130000, 'state' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => '2 Libras', 'price' => 180000, 'state' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
