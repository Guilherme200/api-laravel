<?php

namespace Tests\Unit\Domain\User\Actions;

use App\Domain\User\Actions\Create\CreateUserAction;
use App\Domain\User\Actions\Create\InputUserDto;
use App\Infra\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\Cases\TestCaseUnit;

class CreateUserActionTest extends TestCaseUnit
{
    use RefreshDatabase;

    public function test_create_user(): void
    {
        $data = InputUserDto::from([
            'name' => 'test',
            'email' => 'test@email.com',
            'password' => '12345678'
        ]);

        $this->mock(User::class)
            ->shouldReceive('create')
            ->andReturnTrue();

        $user = (new CreateUserAction())->execute($data);
        $this->assertTrue(!!$user->id);
        $this->assertEquals($user->name, $data->name);
        $this->assertEquals($user->email, $data->email);
        $this->assertTrue(!!Hash::check($data->password, $user->password));
    }
}
