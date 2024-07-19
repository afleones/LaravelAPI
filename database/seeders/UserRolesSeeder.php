<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRolesSeeder extends Seeder
{
    public function run()
    {
        // Obtener los IDs de los roles
        $adminRoleId = DB::table('roles')->where('name', 'admin')->value('id');
        $customerRoleId = DB::table('roles')->where('name', 'customer')->value('id');

        // Asignar roles a usuarios específicos
        DB::table('role_user')->insert([
            [
                'role_id' => $adminRoleId,
                'user_id' => 1, // Asignar al usuario con id 1 el rol de admin
                'state' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => $customerRoleId,
                'user_id' => 2, // Asignar al usuario con id 2 el rol de customer
                'state' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
