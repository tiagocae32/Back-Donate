<?php
use App\Models\User;
use function Pest\Laravel\post;

test("user create ok", function () {

    $user = ["name" => "tiagocae34", "email" => "tiagocae456@gmail.com", "rol_id" => 1, "password" => "123456789"];
    //post("api/donate/registrarUsuario", $user);
    User::create($user);
    $lastUser = User::latest()->first();
    expect($lastUser->name)->toBeString()->not->toBeEmpty();

});