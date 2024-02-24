<?php

namespace App\Providers;

use App\View\Components\Employee\SingleEmployee;
use App\View\Components\Project\ProjectAddService;
use App\View\Components\Project\Services;
use App\View\Components\Project\Team\AssignMember;
use App\View\Components\Project\TopView;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class ComponentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('employee', SingleEmployee::class);
        Blade::component('pr-add-service-form', ProjectAddService::class);
        Blade::component('pr-top-view', TopView::class);
        Blade::component('pr-services', Services::class);
        Blade::component('project-assign-member', AssignMember::class);
    }
}
