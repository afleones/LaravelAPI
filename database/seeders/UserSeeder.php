<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'admin',
                'type_document_id' => 3,
                'identification_number' => 1234567890,
                'email' => 'admin@lionstech.co',
                'email_verified_at' => null,
                'password' => Hash::make('12345678'),
                'state' => 1,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'customer',
                'type_document_id' => 3,
                'identification_number' => 12345678910,
                'email' => 'customer@lionstech.co',
                'email_verified_at' => null,
                'password' => Hash::make('12345678'),
                'state' => 1,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
