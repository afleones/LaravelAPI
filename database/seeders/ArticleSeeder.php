<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Array de nombres de artículos y seriales ficticios
        $articles = [
            ['name' => 'Router Avanzado', 'serial' => 'RT-1234'],
            ['name' => 'Radio Portátil de Comunicaciones', 'serial' => 'RAD-5678'],
            ['name' => 'Antena Exterior para Redes Inalámbricas', 'serial' => 'ANT-8901'],
            ['name' => 'Sistema de Reconocimiento Facial Avanzado', 'serial' => 'SRF-2345'],
            ['name' => 'Huellero Digital de Alta Precisión', 'serial' => 'HD-6789'],
            ['name' => 'Alarma de Seguridad Inteligente', 'serial' => 'ASI-5678'],
            ['name' => 'Control de Acceso Biométrico', 'serial' => 'CAB-3456'],
            ['name' => 'Cámara de Seguridad Exterior', 'serial' => 'CSE-7890'],
            ['name' => 'Sensor de Movimiento Infrarrojo', 'serial' => 'SMI-4567'],
            ['name' => 'Router WiFi de Alta Potencia', 'serial' => 'RWP-2468'],
        ];

        foreach ($articles as $article) {
            DB::table('articles')->insert([
                'name' => $article['name'],
                'serial' => $article['serial'],
                'quantities' => rand(10, 100), // Cantidades aleatorias entre 10 y 100
                'category_id' => rand(1, 10), // ID de categoría aleatorio entre 1 y 10
                'supplier_id' => rand(1, 10), // ID de proveedor aleatorio entre 1 y 10
                'state' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Retorna un proveedor aleatorio.
     *
     * @return string
     */
}
