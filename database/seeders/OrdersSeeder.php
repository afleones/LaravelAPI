<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear algunos usuarios de muestra
        $userIds = DB::table('users')->pluck('id')->toArray();

        // Crear algunos artículos de muestra
        $categoryArticleIds = DB::table('categories_articles')->pluck('id')->toArray();

        // Crear algunos tamaños de muestra
        $sizeIds = DB::table('sizes')->pluck('id')->toArray();

        // Crear algunos sabores de muestra
        $flavorIds = DB::table('flavors')->pluck('id')->toArray();

        // Crear algunos formularios de muestra
        $formIds = DB::table('forms')->pluck('id')->toArray();

        // Crear algunos rellenos de muestra
        $fillingIds = DB::table('fillings')->pluck('id')->toArray();

        // Crear algunos diseños de muestra
        $designIds = DB::table('designs')->pluck('id')->toArray();

        // Crear algunos pedidos de muestra
        $orders = [
            [
                'id_category_article' => $categoryArticleIds[array_rand($categoryArticleIds)],
                'id_user' => $userIds[array_rand($userIds)],
                'id_size' => $sizeIds[array_rand($sizeIds)],
                'id_flavor' => $flavorIds[array_rand($flavorIds)],
                'id_form' => $formIds[array_rand($formIds)],
                'id_filling' => $fillingIds[array_rand($fillingIds)],
                'id_design' => $designIds[array_rand($designIds)],
                'subtotal_order' => 10000.00,
                'total_tax' => 0.00,
                'total_discount' => 1000.00,
                'total_order' => 9000.00,
                'state' => 1
            ],
            [
                'id_category_article' => $categoryArticleIds[array_rand($categoryArticleIds)],
                'id_user' => $userIds[array_rand($userIds)],
                'id_size' => $sizeIds[array_rand($sizeIds)],
                'id_flavor' => $flavorIds[array_rand($flavorIds)],
                'id_form' => $formIds[array_rand($formIds)],
                'id_filling' => $fillingIds[array_rand($fillingIds)],
                'id_design' => $designIds[array_rand($designIds)],
                'subtotal_order' => 15000.00,
                'total_tax' => 0.00,
                'total_discount' => 5000.00,
                'total_order' => 10000.00,
                'state' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Agrega más pedidos según sea necesario
        ];

        // Insertar los pedidos en la base de datos
        foreach ($orders as $order) {
            $orderId = DB::table('orders')->insertGetId($order);

            // Añadir adiciones a los pedidos
            $additionIds = DB::table('additions')->pluck('id')->toArray();
            $additions = [
                ['id_addition' => $additionIds[array_rand($additionIds)], 'quantity' => rand(1, 3)],
                ['id_addition' => $additionIds[array_rand($additionIds)], 'quantity' => rand(1, 3)],
                // Agrega más adiciones según sea necesario
            ];

            foreach ($additions as $addition) {
                DB::table('orders_additions')->insert(array_merge($addition, ['id_order' => $orderId]));
            }
        }
    }
}
