<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Obtén el ID de la categoría "Pasteles"
        $categoryId = DB::table('categories')->where('name', 'Pasteles')->value('id');

        // Obtén los IDs de los artículos
        $articles = DB::table('articles')->pluck('id');

        $categoriesArticles = [];

        foreach ($articles as $articleId) {
            $categoriesArticles[] = [
                'id_category' => $categoryId,
                'id_article' => $articleId,
                'state' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('categories_articles')->insert($categoriesArticles);
    }
}
