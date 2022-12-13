<?php

namespace App\Providers;

use App\Repository\DBGroupRepository;
use App\RepositoryInterface\GroupRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class GroupServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(GroupRepositoryInterface::class,DBGroupRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
