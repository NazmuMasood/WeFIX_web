<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;


use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

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
    public function boot(Dispatcher $events)
    {
        //
        Schema::defaultStringLength(191);

        /**  Shows Reports count in the siderbar */ 
        //if($request->session()->has('reportsCount')) {
            //$events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            //     $factory = new Factory();
            //     $database = $factory->createDatabase();
            //     $reference = $database->getReference('pollution-tracker/reports');
            //     $reports = $reference->getValue();

            //     $counter = 0;
            //     foreach($reports as $report){
            //         $all_reports []= $report;
            //         $counter++;
            //     }

            //     $event->menu->add(['header'=>'NAVIGATION']);
            //     $event->menu->add([
            //         'text'        => 'Reports',
            //         'url'         => '/reports',
            //         'icon'        => 'far fa-fw fa-file',
            //         'label'       => $counter,
            //         'label_color' => 'success',
            //     ]);
            // });
        //}
    }
}
