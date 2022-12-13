<?php

namespace App\Providers;

use App\Repository\DBFileRepository;
use App\RepositoryInterface\FileRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class FileServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(FileRepositoryInterface::class,DBFileRepository::class);
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
