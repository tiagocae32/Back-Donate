<?php

namespace Database\Seeders;

use App\Models\DataProviders\Rol;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'id' => 1,
                'rol' => 'Admin',
            ],
            [
                'id' => 2,
                'rol' => 'User',
            ],
            [
                'id' => 3,
                'rol' => 'Guest',
            ],

        ];
        foreach ($roles as $rol) {
            Rol::create($rol);
        }
    }
}
