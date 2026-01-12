<?php

namespace App\Providers;

use App\Models\Group;
use App\Models\Link;
use Illuminate\Support\ServiceProvider;
use Prophecy\Exception\Exception;
use Illuminate\Support\Facades\URL;

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
        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }
        if (! $this->app->runningInConsole()) {
            // App is not running in CLI context
            // Do HTTP-specific stuff here
            $groups = Group::orderByRaw('LOWER(name) asc')->get();
            foreach ($groups as $g){
                $g['links_total']=Link::where('id_group','=',$g->id)->selectRaw('count(*) as total')->get()[0]['total'];
                $g['links_public']=Link::where('id_group','=',$g->id)->where('public','=','1')->selectRaw('count(*) as total')->get()[0]['total'];
                $g['links_private']=Link::where('id_group','=',$g->id)->where('public','=','0')->selectRaw('count(*) as total')->get()[0]['total'];
            }
            view()->share('groups', $groups);
        }
    }
}
