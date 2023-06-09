<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'nombre' => 'tiagocae32',
                'email' => 'tiagoviezzoli@gmail.com',
                'contraseña' => Hash::make('123456789'),
                'rol_id' => 1
            ],
            [
                'nombre' => 'tiagocae98',
                'email' => 'tiagocae98viezzoli@gmail.com',
                'contraseña' => Hash::make('123456789'),
                'rol_id' => 2
            ],
            [
                'nombre' => 'mariano67',
                'email' => 'mariano@gmail.com',
                'contraseña' => Hash::make('123456789'),
                'rol_id' => 2
            ],
            [
                'nombre' => 'martin',
                'email' => 'martin@gmail.com',
                'contraseña' => Hash::make('123456789'),
                'rol_id' => 3
            ]
        ];
        foreach($users as $user) {
            User::create($user);
        }
    }
}
