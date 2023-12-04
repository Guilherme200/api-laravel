<?php

namespace App\Providers;

use App\Domain\User\Repositories\UserRepository;
use App\Infra\Models\User;
use App\Infra\Repositories\Eloquent\UserRepositoryEloquent;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserRepository::class, function ($app) {
            return new UserRepositoryEloquent($app->make(User::class));
        });
    }
}
