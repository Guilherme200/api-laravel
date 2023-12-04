<?php

namespace Tests\Unit\Domain\User\Actions\Update;

use App\Domain\Shared\Exceptions\NotFoundException;
use App\Domain\User\Actions\Update\UpdateUserDto;
use App\Domain\User\Actions\Update\UpdateUserAction;
use App\Domain\User\Data\UserData;
use App\Domain\User\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\Cases\TestCaseUnit;

class UpdateUserActionTest extends TestCaseUnit
{
    use RefreshDatabase;

    /**
     * @throws NotFoundException
     */
    public function test_should_success_update_user(): void
    {
        $id = '786f8013-3ebe-4aee-ad9f-e857c5d5d887';
        $data = UpdateUserDto::from([
            'name' => 'test',
            'email' => 'test@email.com',
            'password' => '12345678'
        ]);

        $userOutput = UserData::from([
            'id' => $id,
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password123'),
            'createdAt' => now(),
            'updatedAt' => now()
        ]);

        $userMock = $this->mock(UserRepository::class);

        $userMock->shouldReceive('findById')
            ->with($id)
            ->andReturn($userOutput);

        $userMock->shouldReceive('update');

        $user = (new UpdateUserAction())->execute($id, $data);

        $this->assertInstanceOf(UserData::class, $user);
        $this->assertNotNull($user->id);
        $this->assertTrue(Hash::check($data->password, $user->password));
        $this->assertInstanceOf(Carbon::class, $user->createdAt);
        $this->assertInstanceOf(Carbon::class, $user->updatedAt);
    }

    public function test_should_throw_exception_update_user(): void
    {
        $id = '786f8013-3ebe-4aee-ad9f-e857c5d5d887';
        $data = UpdateUserDto::from([
            'name' => 'test',
            'email' => 'test@email.com',
            'password' => '12345678'
        ]);

        $userMock = $this->mock(UserRepository::class);

        $userMock->shouldReceive('findById')
            ->with($id)
            ->andReturn(null);

        $this->expectException(NotFoundException::class);
        $this->expectExceptionMessage('User not found');
        (new UpdateUserAction())->execute($id, $data);
    }
}
