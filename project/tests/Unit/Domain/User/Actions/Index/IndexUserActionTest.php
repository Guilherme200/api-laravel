<?php

namespace Tests\Unit\Domain\User\Actions\Index;

use App\Domain\Shared\Exceptions\NotFoundException;
use App\Domain\User\Actions\Index\IndexUserAction;
use App\Domain\User\Repositories\UserRepository;
use Tests\Cases\TestCaseUnit;

class IndexUserActionTest extends TestCaseUnit
{
    /**
     * @throws NotFoundException
     */
    public function test_should_success_index_user(): void
    {
        $userMock = $this->mock(UserRepository::class);
        $userMock->shouldReceive('pagination')
            ->once();

        (new IndexUserAction())->execute();
    }
}
