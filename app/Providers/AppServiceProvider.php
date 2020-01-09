<?php

namespace App\Providers;

use App\Contracts\Categories;
use App\Contracts\Channels;
use App\Contracts\Medias;
use App\Contracts\Posts;
use App\Services\CategoryService;
use App\Services\ChannelService;
use App\Services\MediaService;
use App\Services\PostService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Posts::class, function() {
            return new PostService();
        });

        $this->app->singleton(Channels::class, function() {
            return new ChannelService();
        });

        $this->app->singleton(Categories::class, function () {
            return new CategoryService();
        });

        $this->app->singleton(Medias::class, function () {
            return new MediaService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
