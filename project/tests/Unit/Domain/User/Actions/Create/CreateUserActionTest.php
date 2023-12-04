<?php

namespace Tests\Unit\Domain\User\Actions\Create;

use App\Domain\User\Actions\Create\CreateUserAction;
use App\Domain\User\Actions\Create\CreateUserDto;
use App\Domain\User\Data\UserData;
use App\Domain\User\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\Cases\TestCaseUnit;

class CreateUserActionTest extends TestCaseUnit
{
    use RefreshDatabase;

    public function test_should_success_create_user(): void
    {
        $data = CreateUserDto::from([
            'name' => 'test',
            'email' => 'test@email.com',
            'password' => '12345678'
        ]);

        $this->mock(UserRepository::class)
            ->shouldReceive('create');

        $user = (new CreateUserAction())->execute($data);
        $this->assertInstanceOf(UserData::class, $user);
        $this->assertNotNull($user->id);
        $this->assertTrue(Hash::check($data->password, $user->password));
        $this->assertInstanceOf(Carbon::class, $user->createdAt);
        $this->assertInstanceOf(Carbon::class, $user->updatedAt);
    }
}
