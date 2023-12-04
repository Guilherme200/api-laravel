<?php

namespace Tests\Unit\Domain\User\Actions\Update;

use App\Domain\Shared\Exceptions\NotFoundException;
use App\Domain\User\Actions\Update\UpdateUserDto;
use App\Domain\User\Actions\Update\UpdateUserAction;
use App\Infra\Models\User;
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

        $userMock = $this->mock(User::class);

        $userMock->shouldReceive('find')
            ->with($id)
            ->andReturn(new User([
                'id' => $id,
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
                'email_verified_at' => now(),
            ]));

        $userMock->shouldReceive('update')
            ->andReturnTrue();

        $user = (new UpdateUserAction())->execute($id, $data);

        $this->assertTrue(!!$user->id);
        $this->assertEquals($user->name, $data->name);
        $this->assertEquals($user->email, $data->email);
        $this->assertTrue(!!Hash::check($data->password, $user->password));
    }

    public function test_should_throw_exception_update_user(): void
    {
        $id = '786f8013-3ebe-4aee-ad9f-e857c5d5d887';

        $data = UpdateUserDto::from([
            'name' => 'test',
            'email' => 'test@email.com',
            'password' => '12345678'
        ]);

        $userMock = $this->mock(User::class);

        $userMock->shouldReceive('find')
            ->andReturn(null);

        $this->expectException(NotFoundException::class);
        $this->expectExceptionMessage('User not found');
        (new UpdateUserAction())->execute($id, $data);
    }
}
