<?php

namespace App\Providers;

use App\Domain\User\Repositories\UserRepository;
use App\Infra\Eloquent\User\Repositories\UserRepositoryEloquent;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserRepository::class, function () {
            return new UserRepositoryEloquent();
        });
    }
}
