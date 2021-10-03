<?php

namespace App\Providers;
use App\Models\Post;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        $data=Post::orderBy('id','DESC')->limit(5)->get();
        $popularpost_data=Post::orderBy('views','DESC')->limit(5)->get();

        View::share('recent_posts',$data);
        View::share('popular_posts',$popularpost_data);

    }
}
