<?php

namespace App\Infra\Eloquent\User;

use App\Domain\User\Data\UserData;
use App\Domain\User\Repositories\UserRepository;
use App\Infra\Eloquent\Shared\Support\PaginationBuilder;
use Illuminate\Http\Resources\Json\JsonResource;

class UserRepositoryEloquent implements UserRepository
{
    private User|null $model;

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

    public function update(UserData $dto): UserData
    {
        $this->model->update([
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

    public function findById(string $id): UserData|null
    {
        $this->model = $this->model->find($id);

        if (!$this->model) {
            return null;
        }

        return UserData::from([
            'id' => $this->model->id,
            'name' => $this->model->name,
            'email' => $this->model->email,
            'emailVerifiedAt' => $this->model->email_verified_at,
            'password' => $this->model->password,
            'createdAt' => $this->model->created_at,
            'updatedAt' => $this->model->updated_at
        ]);
    }

    public function delete(string $id): bool
    {
        try {
            $this->model->findOrFail($id)->delete();
            return true;
        } catch (\Exception) {
            return false;
        }
    }

    public function pagination(): JsonResource
    {
        return PaginationBuilder::for($this->model)
            ->perPage(15)
            ->filterBy(['name' => 'test'])
            ->build();
    }
}
