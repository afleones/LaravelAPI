<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            TypeDocumentsIdentificationsSeeder::class,
            UserSeeder::class,
            CategoriesSeeder::class,
            ArticlesSeeder::class,
            CategoriesArticlesSeeder::class,
            FlavorsSeeder::class,
            RoleSeeder::class,
            SizesSeeder::class,
            FillingsSeeder::class,
            UserRolesSeeder::class,
            FormsSeeder::class,
            DesignsSeeder::class,
            AdditionsSeeder::class,
            OrdersSeeder::class,
            CustomersSeeder::class,
        ]);

        $this->command->info('Seeders ejecutados correctamente.');
    } 
}
