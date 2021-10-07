<?php

namespace App\Providers;
use App\Models\Post;
use App\Models\Setting;


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
        $newdata=Setting::first();
        $data=Post::orderBy('id','DESC')->limit($newdata->recent_limit)->get();
        $popularpost_data=Post::orderBy('views','DESC')->limit($newdata->popular_limit)->get();

        View::share('recent_posts',$data);
        View::share('popular_posts',$popularpost_data);

    }
}
