<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Logo;
use App\Menu;
use App\Content;
use App\NewsEvent;
use App\Fixbanner;

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
       view()->composer('*', function($view){		
			$logos = Logo::all();
			$menus = Menu::where('parent_id',NULL)->get();	
			$contactus = Content::where('menu_id',1)->first();	
			$latestupdate = NewsEvent::where('status',1)->get();
			$fixbanner = Fixbanner::where('status',1)->orderBy('id','DESC')->first();	
			
			return $view->with(['logos'=>$logos,'menus'=>$menus,'contactus'=>$contactus,'latestupdate'=>$latestupdate,'fixbanner'=>$fixbanner]);
		});
    }
}
