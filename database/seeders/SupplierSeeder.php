<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('suppliers')->insert([
            [
                'name' => 'Proveedor Telecom S.A.S.',
                'nit' => '123456789',
                'phone' => '3219876543',
                'email' => 'proveedor_telecom@example.com',
                'address' => 'Carrera 10 #20-30, Bogotá',
                'state' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Radios Unidos S.A.',
                'nit' => '987654321',
                'phone' => '2109876543',
                'email' => 'radios_unidos@example.com',
                'address' => 'Calle 50 #30-40, Medellín',
                'state' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Antenas Rápidas Ltda.',
                'nit' => '654321987',
                'phone' => '3108765432',
                'email' => 'antenas_rapidas@example.com',
                'address' => 'Avenida 80 #25-15, Cali',
                'state' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Biometrics Solutions S.A.S.',
                'nit' => '789456123',
                'phone' => '3007654321',
                'email' => 'biometrics_solutions@example.com',
                'address' => 'Carrera 15 #40-50, Barranquilla',
                'state' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Security Alarms S.A.',
                'nit' => '456789123',
                'phone' => '3506543210',
                'email' => 'security_alarms@example.com',
                'address' => 'Diagonal 70 #10-20, Cartagena',
                'state' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Redes S.A.S.',
                'nit' => '147258369',
                'phone' => '3206549870',
                'email' => 'redes_sas@example.com',
                'address' => 'Avenida 100 #15-25, Bogotá',
                'state' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sensores Tech Ltda.',
                'nit' => '369258147',
                'phone' => '3109876543',
                'email' => 'sensores_tech@example.com',
                'address' => 'Carrera 25 #30-40, Medellín',
                'state' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sistemas Biométricos Ltda.',
                'nit' => '258369147',
                'phone' => '3008765432',
                'email' => 'sistemas_biometricos@example.com',
                'address' => 'Calle 70 #25-15, Cali',
                'state' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Alarmas Plus S.A.S.',
                'nit' => '963852741',
                'phone' => '3507654321',
                'email' => 'alarmas_plus@example.com',
                'address' => 'Diagonal 50 #30-20, Barranquilla',
                'state' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ConectaNet Ltda.',
                'nit' => '785412369',
                'phone' => '3106543210',
                'email' => 'conectanet@example.com',
                'address' => 'Avenida 80 #10-30, Cartagena',
                'state' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
