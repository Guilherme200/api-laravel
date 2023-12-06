<?php

namespace App\Domain\User\Actions\Show;

use App\Domain\Shared\Exceptions\NotFoundException;
use App\Domain\User\Data\UserData;
use App\Domain\User\Repositories\UserRepository;

class ShowUserAction
{
    private mixed $repository;

    public function __construct()
    {
        $this->repository = app(UserRepository::class);
    }

    /**
     * @throws NotFoundException
     */
    public function execute(string $id): UserData
    {
        $user = $this->repository->findById($id);

        if (!$user) {
            throw new NotFoundException('User not found');
        }

        return $user;
    }
}
