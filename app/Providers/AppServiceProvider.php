<?php

namespace App\Providers;

use App\Models\GroupUser;
use App\Observers\AddUserToGroupObserver;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        JsonResource::withoutWrapping();
        GroupUser::observe(AddUserToGroupObserver::class);
    }
}
