<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      Schema::defaultStringLength(191);

      if(Schema::hasTable('ksdkfakjsdkfasdjwd')) {
        $timexone = get_option('timezone');
        if($timexone == '') {
          $timexone = 'Asia/Dhaka';
        }
        date_default_timezone_set($timexone);
      } else {
        date_default_timezone_set('Asia/Dhaka');
      }
      
      // default timezone
      
    }
}
