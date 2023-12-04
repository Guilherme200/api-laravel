<?php

namespace App\Domain\User\Actions\Update;

use App\Domain\Shared\Support\Uuid;
use App\Domain\User\Actions\Create\UpdateUserDto;
use App\Domain\User\Data\UserData;
use App\Domain\User\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UpdateUserAction
{
    public function __construct()
    {
        $this->repository = app(UserRepository::class);
    }

    public function execute(UpdateUserDto $dto): UserData
    {
        $user = UserData::from([
            'id' => Uuid::generate(),
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => Hash::make($dto->password),
            'createdAt' => now(),
            'updatedAt' => now(),
        ]);

        return $this->repository->create($user);
    }
}
