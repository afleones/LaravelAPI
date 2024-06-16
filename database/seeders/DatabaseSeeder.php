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
        // Llama a cada seeder que deseas ejecutar
        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserRolesSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(SupplierSeeder::class);
        $this->call(ArticleSeeder::class);
        // Agrega más llamadas aquí según sea necesario para otros seeders

        $this->command->info('Seeders ejecutados correctamente.');
    } 
}
