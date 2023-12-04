<?php

namespace Tests\Unit\Domain\User\Actions\Read;

use App\Domain\Shared\Exceptions\NotFoundException;
use App\Domain\User\Actions\Read\ReadUserAction;
use App\Domain\User\Data\UserData;
use App\Domain\User\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Tests\Cases\TestCaseUnit;

class ReadUserActionTest extends TestCaseUnit
{
    /**
     * @throws NotFoundException
     */
    public function test_should__success_read_user(): void
    {
        $userOutput = UserData::from([
            'id' => '786f8013-3ebe-4aee-ad9f-e857c5d5d887',
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password123'),
            'createdAt' => now(),
            'updatedAt' => now(),
            'emailVerifiedAt' => now(),
        ]);

        $userMock = $this->mock(UserRepository::class);
        $userMock->shouldReceive('findById')
            ->andReturn($userOutput);

        $user = (new ReadUserAction())->execute($userOutput->id);
        $this->assertEquals($user, $userOutput);
    }

    public function test_should_throw_exception_read_user(): void
    {
        $id = '786f8013-3ebe-4aee-ad9f-e857c5d5d887';
        $userMock = $this->mock(UserRepository::class);
        $userMock->shouldReceive('findById')
            ->andReturn(null);

        $this->expectException(NotFoundException::class);
        $this->expectExceptionMessage('User not found');
        (new ReadUserAction())->execute($id);
    }
}
