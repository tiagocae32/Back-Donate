<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface ResourceController
{
    public function index(); // GET

    public function store(Request $request); // POST
}
