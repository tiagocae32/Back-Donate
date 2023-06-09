<?php

use function Pest\Laravel\post;

test("user create ok", function () {

    $user = [
        "nombre" => fake()->nombre(),
        "email" => fake()->unique()->safeEmail(), 
        "rol_id" => fake()->numberBetween(1,3), 
        "contraseña" => fake()->contraseña()
    ];
    $response = post("api/donate/registrarUsuario", $user);
    expect($response->status())->toEqual(200);
});