<?php

namespace Tests\Unit\Domain\User\Actions;

use App\Domain\User\Actions\Create\CreateUserAction;
use App\Domain\User\Actions\Create\InputUserDto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CreateUserActionTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_user(): void
    {
        $data = InputUserDto::from([
            'name' => 'test',
            'email' => 'test@email.com',
            'password' => '12345678'
        ]);

        $user = (new CreateUserAction())->execute($data);
        $this->assertTrue(!!$user->id);
        $this->assertEquals($user->name, $data->name);
        $this->assertEquals($user->email, $data->email);
        $this->assertTrue(!!Hash::check($data->password, $user->password));
    }
}
