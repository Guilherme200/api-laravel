<?php

namespace App\Domain\User\Actions\Update;

use Spatie\LaravelData\Data;

class UpdateUserDto extends Data
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password
    )
    {
    }
}
