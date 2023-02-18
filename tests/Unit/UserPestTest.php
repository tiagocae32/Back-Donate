<?php

use function Pest\Laravel\post;

test("user create ok", function () {

    $user = [
        "name" => fake()->name(),
        "email" => fake()->unique()->safeEmail(), 
        "rol_id" => fake()->numberBetween(1,3), 
        "password" => fake()->password()
    ];
    $response = post("api/donate/registrarUsuario", $user);
    expect($response->status())->toEqual(200);
});