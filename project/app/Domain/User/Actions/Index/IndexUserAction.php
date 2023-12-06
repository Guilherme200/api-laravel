<?php

namespace App\Domain\User\Actions\Index;

use App\Domain\Shared\Exceptions\NotFoundException;
use App\Domain\User\Repositories\UserRepository;

class IndexUserAction
{
    private mixed $repository;

    public function __construct()
    {
        $this->repository = app(UserRepository::class);
    }

    /**
     * @throws NotFoundException
     */
    public function execute()
    {
        return $this->repository->pagination();
    }
}
