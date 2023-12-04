<?php

namespace App\Infra\Repositories\Eloquent;


use App\Domain\User\Data\UserData;
use App\Domain\User\Repositories\UserRepository;
use App\Infra\Models\User;

class UserRepositoryEloquent implements UserRepository
{
    private User $model;

    public function __construct()
    {
        $this->model = app(User::class);
    }

    public function create(UserData $dto): UserData
    {
        $this->model->create([
            'id' => $dto->id,
            'name' => $dto->name,
            'email' => $dto->email,
            'email_verified_at' => $dto->emailVerifiedAt,
            'password' => $dto->password,
            'created_at' => $dto->createdAt,
            'updated_at' => $dto->updatedAt,
        ]);
        return $dto;
    }
}
