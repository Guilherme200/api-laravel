<?php

namespace App\Domain\User\Repositories;

use App\Domain\User\Data\UserData;

interface UserRepository
{
    public function create(UserData $dto): UserData;
}
