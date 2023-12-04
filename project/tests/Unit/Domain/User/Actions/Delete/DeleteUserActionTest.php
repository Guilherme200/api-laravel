<?php

namespace Tests\Unit\Domain\User\Actions\Delete;

use App\Domain\Shared\Exceptions\NotFoundException;
use App\Domain\User\Actions\Delete\DeleteUserAction;
use App\Domain\User\Repositories\UserRepository;
use Tests\Cases\TestCaseUnit;

class DeleteUserActionTest extends TestCaseUnit
{
    /**
     * @throws NotFoundException
     */
    public function test_should_success_delete_user(): void
    {
        $id = '786f8013-3ebe-4aee-ad9f-e857c5d5d887';

        $userMock = $this->mock(UserRepository::class);
        $userMock->shouldReceive('delete')
            ->with($id)
            ->andReturn(true);

        $userWasDeleted = (new DeleteUserAction())->execute($id);
        $this->assertTrue($userWasDeleted);
    }

    public function test_should_throw_exception_delete_user(): void
    {
        $id = '786f8013-3ebe-4aee-ad9f-e857c5d5d887';

        $userMock = $this->mock(UserRepository::class);
        $userMock->shouldReceive('delete')
            ->with($id)
            ->andThrowExceptions([
                new NotFoundException('User not found')
            ]);

        $this->expectException(NotFoundException::class);
        $this->expectExceptionMessage('User not found');
        (new DeleteUserAction())->execute($id);
    }
}
