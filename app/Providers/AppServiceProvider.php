<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        if(file_exists(storage_path('installed'))){
        if (Schema::hasTable('general_settings')) {
            $siteInfo = DB::table('general_settings')->first();
        }
        if (Schema::hasTable('social_links')) {
            $social = DB::table('social_links')->get();
        }

        view()->share(['siteInfo'=> $siteInfo,'social'=>$social]);
        }
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
