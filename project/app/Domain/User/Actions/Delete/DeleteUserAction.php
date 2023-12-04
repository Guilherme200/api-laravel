<?php

namespace App\Domain\User\Actions\Delete;

use App\Domain\Shared\Exceptions\NotFoundException;
use App\Domain\User\Repositories\UserRepository;

class DeleteUserAction
{
    private mixed $repository;

    public function __construct()
    {
        $this->repository = app(UserRepository::class);
    }

    /**
     * @throws NotFoundException
     */
    public function execute(string $id): bool
    {
        try {
            return $this->repository->delete($id);
        } catch (\Exception) {
            throw new NotFoundException('User not found');
        }
    }
}
