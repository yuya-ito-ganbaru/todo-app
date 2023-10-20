<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Folder;
use App\Policies\FolderPolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
    protected $policies =[
        Folder::class => FolderPolicy::class,
    ];
}
