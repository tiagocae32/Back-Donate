<?php

namespace Database\Seeders;

use App\Models\DataProviders\RolPermiso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesPermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rolesPermisos = [
            ['rol_id' =>  1, 'permiso_id' => 1],
            ['rol_id' =>  2, 'permiso_id' => 1],
            ['rol_id' =>  2, 'permiso_id' => 2],
            ['rol_id' =>  2, 'permiso_id' => 3],
            ['rol_id' =>  2, 'permiso_id' => 4],
            ['rol_id' =>  2, 'permiso_id' => 5],
            ['rol_id' =>  3, 'permiso_id' => 1],
            ['rol_id' =>  3, 'permiso_id' => 2],
        ];
        foreach($rolesPermisos as $rolPermiso) {
            RolPermiso::firstOrCreate($rolPermiso);
        }
    }
}