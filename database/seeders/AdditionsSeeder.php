<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdditionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('additions')->insert([
            // Datos existentes
            [
                'name' => 'Grageas Doradas',
                'description' => '20gr aprox',
                'price' => 3000,
                'state' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Grageas Plateadas',
                'description' => '20gr aprox',
                'price' => 3000,
                'state' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Grageas Colores',
                'description' => '20gr aprox',
                'price' => 2000,
                'state' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Grageas Blancas',
                'description' => '20gr aprox',
                'price' => 3000,
                'state' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Toppers',
                'description' => 'HB FC a disponibilidad',
                'price' => 10000,
                'state' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Toppers en Acrilico',
                'description' => 'personalizados',
                'price' => 20000,
                'state' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Drip de Chocolate',
                'description' => 'color a elegir',
                'price' => 5000,
                'state' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Chocolates',
                'description' => 'Tipo jet, Corazon, Cuadradas, etc',
                'price' => 1000,
                'state' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Clavel',
                'description' => 'Unidad',
                'price' => 5000,
                'state' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rosas Naturales',
                'description' => 'Unidad',
                'price' => 5000,
                'state' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Esferas de Chocolate',
                'description' => 'Tamaños varios',
                'price' => 1500,
                'state' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gyosofilia',
                'description' => 'Ramo pequeño',
                'price' => 3000,
                'state' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ponpon',
                'description' => 'Unidad',
                'price' => 2000,
                'state' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Margaritas',
                'description' => 'Ramo pequeño',
                'price' => 3000,
                'state' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Alfajor tipo Macarrons',
                'description' => 'Unidad',
                'price' => 1500,
                'state' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cupcake',
                'description' => 'Unidad',
                'price' => 3000,
                'state' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mini Donas',
                'description' => 'Unidad',
                'price' => 3000,
                'state' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Papeleria Creativa',
                'description' => 'Paquete',
                'price' => 15000,
                'state' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Conchas de mar en fondant pequeñas 3D',
                'description' => 'Unidad',
                'price' => 1000,
                'state' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Letras en fondant pequeñas planas',
                'description' => 'Unidad',
                'price' => 1000,
                'state' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Nuevos datos
            [
                'name' => 'Fresas',
                'description' => 'Unidad',
                'price' => 1000,
                'state' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kiwii',
                'description' => 'Unidad',
                'price' => 3000,
                'state' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Piazzas',
                'description' => 'Unidad',
                'price' => 1000,
                'state' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Chips de chocolate',
                'description' => '20grs aprox',
                'price' => 3000,
                'state' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Numeros en fondant pequeños planos',
                'description' => 'Unidad',
                'price' => 2000,
                'state' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Numeros en fondant grandes planos',
                'description' => 'Unidad',
                'price' => 2000,
                'state' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Letras en fondant grandes planas',
                'description' => 'Unidad',
                'price' => 2000,
                'state' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
