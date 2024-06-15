<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SuppliersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = [
            [
                'name' => 'Motorola Solutions',
                'nit' => '123456789',
                'phone' => '555-1234',
                'email' => 'info@motorolasolutions.com',
                'address' => '500 W Monroe St, Chicago, IL 60661, USA',
                'state' => true,
            ],
            [
                'name' => 'Kenwood Communications',
                'nit' => '987654321',
                'phone' => '555-5678',
                'email' => 'info@kenwood.com',
                'address' => '2201 E Dominguez St, Long Beach, CA 90810, USA',
                'state' => true,
            ],
            [
                'name' => 'Hytera Communications',
                'nit' => '192837465',
                'phone' => '555-8765',
                'email' => 'info@hytera.com',
                'address' => 'HYT Tower, Hi-Tech Industrial Park North, Nanshan District, Shenzhen, China',
                'state' => true,
            ],
            [
                'name' => 'Icom Incorporated',
                'nit' => '123123123',
                'phone' => '555-4321',
                'email' => 'info@icom.co.jp',
                'address' => '1-1-32 Kamiminami, Hirano-ku, Osaka 547-0003, Japan',
                'state' => true,
            ],
            [
                'name' => 'Vertex Standard',
                'nit' => '321321321',
                'phone' => '555-6789',
                'email' => 'info@vertexstandard.com',
                'address' => '3-8-14 Kamiochiai, Shinjuku-ku, Tokyo 161-0034, Japan',
                'state' => true,
            ],
            [
                'name' => 'Sepura PLC',
                'nit' => '456456456',
                'phone' => '555-9876',
                'email' => 'info@sepura.com',
                'address' => 'Radio House, St Andrew’s Road, Cambridge, CB4 1GR, United Kingdom',
                'state' => false,
            ],
            [
                'name' => 'Tait Communications',
                'nit' => '654654654',
                'phone' => '555-6543',
                'email' => 'info@taitradio.com',
                'address' => '558 Wairakei Road, Burnside, Christchurch 8053, New Zealand',
                'state' => true,
            ],
        ];

        DB::table('suppliers')->insert($suppliers);
    }
}
