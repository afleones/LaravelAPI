<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeDocumentsIdentificationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('type_documents_identifications')->insert([
            ['id' => 1, 'name' => 'Registro civil', 'state' => 1, 'created_at'=> now(), 'updated_at'=> now()],
            ['id' => 2, 'name' => 'Tarjeta de identidad', 'state' => 1, 'created_at'=> now(), 'updated_at'=> now()],
            ['id' => 3, 'name' => 'Cédula de ciudadanía', 'state' => 1, 'created_at'=> now(), 'updated_at'=> now()],
            ['id' => 4, 'name' => 'Tarjeta de extranjería', 'state' => 1, 'created_at'=> now(), 'updated_at'=> now()],
            ['id' => 5, 'name' => 'Cédula de extranjería', 'state' => 1, 'created_at'=> now(), 'updated_at'=> now()],
            ['id' => 6, 'name' => 'NIT', 'state' => 1, 'created_at'=> now(), 'updated_at'=> now()],
            ['id' => 7, 'name' => 'Pasaporte', 'state' => 1, 'created_at'=> now(), 'updated_at'=> now()],
            ['id' => 8, 'name' => 'Documento de identificación extranjero', 'state' => 1, 'created_at'=> now(), 'updated_at'=> now()],
            ['id' => 9, 'name' => 'NIT de otro país', 'state' => 1, 'created_at'=> now(), 'updated_at'=> now()],
            ['id' => 10, 'name' => 'NUIP *', 'state' => 1, 'created_at'=> now(), 'updated_at'=> now()],
            ['id' => 11, 'name' => 'PEP (Permiso Especial de Permanencia)', 'state' => 1, 'created_at'=> now(), 'updated_at'=> now()],
            ['id' => 12, 'name' => 'PPT (Permiso Protección Temporal)', 'state' => 1, 'created_at'=> now(), 'updated_at'=> now()],
        ]);
    }
}
