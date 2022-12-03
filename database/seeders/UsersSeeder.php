<?php

namespace Database\Seeders;

use App\Models\User\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
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
                'name' => 'tiagocae32',
                'email' => 'tiagoviezzoli@gmail.com',
                'password' => Hash::make('123456789'),
                'rol_id' => 1
            ],
            [
                'name' => 'tiagocae98',
                'email' => 'tiagocae98viezzoli@gmail.com',
                'password' => Hash::make('123456789'),
                'rol_id' => 2
            ],
            [
                'name' => 'mariano67',
                'email' => 'mariano@gmail.com',
                'password' => Hash::make('123456789'),
                'rol_id' => 2
            ],
            [
                'name' => 'martin',
                'email' => 'martin@gmail.com',
                'password' => Hash::make('123456789'),
                'rol_id' => 3
            ]
        ];
        foreach($users as $user) {
            User::firstOrCreate($user);
        }
    }
}
