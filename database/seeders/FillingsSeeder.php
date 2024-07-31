<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FillingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('fillings')->insert([
            ['name' => 'Arequipe', 'state' => 1, 'created_at'=> now(), 'updated_at'=> now()],
            ['name' => 'Ganache de chocolate', 'state' => 1, 'created_at'=> now(), 'updated_at'=> now()],
            ['name' => 'Chantilly', 'state' => 1, 'created_at'=> now(), 'updated_at'=> now()],
            ['name' => 'Buttercream', 'state' => 1, 'created_at'=> now(), 'updated_at'=> now()],
            ['name' => 'Frutos rojos', 'state' => 1, 'created_at'=> now(), 'updated_at'=> now()],
        ]);
    }
}
