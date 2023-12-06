<?php

namespace App\Domain\User\Repositories;

use App\Domain\User\Data\UserData;
use Illuminate\Http\Resources\Json\JsonResource;

interface UserRepository
{
    public function create(UserData $dto): UserData;

    public function update(UserData $dto): UserData;

    public function findById(string $id): UserData|null;

    public function delete(string $id): bool;

    public function pagination(): JsonResource;
}
