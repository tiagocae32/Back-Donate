<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Contracts\Validation\Validator;

class ValidationsException extends Exception
{
    protected $validator;

    protected $code;

    public function __construct(Validator $validator, int $code)
    {
        $this->validator = $validator;
        $this->code = $code;
    }

    public function render()
    {
        errors(['errors' => $this->validator->errors()->all()], $this->code);
    }
}
