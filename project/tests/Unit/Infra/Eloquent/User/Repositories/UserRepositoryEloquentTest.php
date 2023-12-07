<?php

namespace Tests\Unit\Infra\Eloquent\User\Repositories;

use App\Domain\User\Data\UserData;
use App\Infra\Eloquent\User\User;
use App\Infra\Eloquent\User\UserRepositoryEloquent;
use Illuminate\Support\Facades\Hash;
use Tests\Cases\TestCaseUnit;

class UserRepositoryEloquentTest extends TestCaseUnit
{
    public function test_repository_should_success_create_user(): void
    {
        $userData = UserData::from([
            'id' => '786f8013-3ebe-4aee-ad9f-e857c5d5d887',
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password123'),
            'createdAt' => now(),
            'updatedAt' => now(),
            'emailVerifiedAt' => now(),
        ]);

        $this->mock(User::class)
            ->shouldReceive('create')
            ->once();

        (new UserRepositoryEloquent())->create($userData);
    }

    public function test_repository_should_success_update_user(): void
    {
        $userData = UserData::from([
            'id' => '786f8013-3ebe-4aee-ad9f-e857c5d5d887',
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password123'),
            'createdAt' => now(),
            'updatedAt' => now(),
            'emailVerifiedAt' => now(),
        ]);

        $this->mock(User::class)
            ->shouldReceive('update')
            ->once();

        (new UserRepositoryEloquent())->update($userData);
    }

    public function test_repository_should_success_delete_user(): void
    {
        $id = '786f8013-3ebe-4aee-ad9f-e857c5d5d887';
        $userMock = $this->mock(User::class);
        $userMock->shouldReceive('findOrFail')
            ->with($id)
            ->andReturn(new User(['id' => $id]));

        $userMock->shouldReceive('delete');

        $userWasDeleted = (new UserRepositoryEloquent())->delete($id);
        $this->assertTrue($userWasDeleted);
    }
}
