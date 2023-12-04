<?php

namespace App\Domain\User\Data;

use Carbon\Carbon;
use Spatie\LaravelData\Data;

class UserData extends Data
{
    public function __construct(
        public string $id,
        public string $name,
        public string $email,
        public string $password,
        public Carbon $createdAt,
        public Carbon $updatedAt,
        public Carbon|null $emailVerifiedAt,
    )
    {
    }
}
