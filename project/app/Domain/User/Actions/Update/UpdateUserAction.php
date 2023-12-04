<?php

namespace App\Domain\User\Actions\Update;

use App\Domain\Shared\Exceptions\NotFoundException;
use App\Domain\User\Data\UserData;
use App\Domain\User\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UpdateUserAction
{
    private mixed $repository;

    public function __construct()
    {
        $this->repository = app(UserRepository::class);
    }

    /**
     * @throws NotFoundException
     */
    public function execute(string $id, UpdateUserDto $dto): UserData
    {
        $user = $this->repository->findById($id);

        if (!$user) {
            throw new NotFoundException('User not found');
        }

        $user = UserData::from([
            'id' => $user->id,
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => $dto->password ? Hash::make($dto->password) : $user->password,
            'createdAt' => $user->createdAt,
            'updatedAt' => now(),
        ]);

        $this->repository->update($user);
        return $user;
    }
}
