<?php

namespace App\Infra\Repositories\InMemory;


use App\Domain\User\Actions\Create\InputUserDto;
use App\Domain\User\Data\UserData;
use App\Domain\User\Repositories\UserRepository;
use App\Infra\Models\User;

class UserRepositoryInMemory implements UserRepository
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function create(InputUserDto $dto): UserData
    {
        return UserData::from([
            'id' => 1,
            'name' => 'test',
            'email' => 'test@email.com',
            'emailVerifiedAt' => now(),
            'password' => '12345678',
            'createdAt' => now(),
            'updatedAt' => now()
        ]);
    }
}
