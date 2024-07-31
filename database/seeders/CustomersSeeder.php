<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('customers')->insert([
            [
                'name' => 'customer',
                'user_id' => 2,
                'address' => 'CLL 111  16 21', // Cambia esto por la dirección que desees
                'type_document_id' => 3,
                'identification_number' => 12345678910,
                'email' => 'customer@lionstech.co',
                'phone' => '123-456-7890', // Cambia esto por el número de teléfono que desees
                'state' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
