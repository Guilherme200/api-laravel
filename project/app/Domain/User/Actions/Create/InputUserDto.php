<?php

namespace App\Domain\User\Actions\Create;

use Spatie\LaravelData\Data;

class InputUserDto extends Data
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password
    )
    {
    }
}
