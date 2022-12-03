<?php

namespace Database\Seeders;

use App\Models\User\Permiso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permisos = [
            ['permiso' => 'Ver campañas'],
            ['permiso' => 'Buscar campañas'],
            ['permiso' => 'Crear campaña'],
            ['permiso' => 'Crear comentario'],
            ['permiso' => 'Realizar donacion'],
        ];
        foreach($permisos as $permiso) {
            Permiso::firstOrCreate($permiso);
        }
    }
}
