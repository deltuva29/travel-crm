<?php

namespace App\Providers;

use App\Nova\Role;
use App\Nova\User;
use App\Policies\NovaPermissionPolicy;
use App\Policies\NovaRolePolicy;
use DigitalCreative\CollapsibleResourceManager\CollapsibleResourceManager;
use DigitalCreative\CollapsibleResourceManager\Resources\TopLevelResource;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Vyuldashev\NovaPermission\NovaPermissionTool;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return true;
        });
    }

    /**
     * Get the cards that should be displayed on the default Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        return [
            new Help,
        ];
    }

    /**
     * Get the extra dashboards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools(): array
    {
//        $mainResourcesOfMainMenu = [];
//        $mainResourcesOfMainMenu[] = \App\Nova\DocumentForDownload::class;
//
//        if (auth()->user()->hasPermissionTo('Redaguoti sąskaitas')) {
//            $mainResourcesOfMainMenu[] = \App\Nova\InvoiceGeneration::class;
//        }
//        $mainResourcesOfMainMenu[] = \App\Nova\Invoice::class;
//
//        $groupsOfMenuItemsToReturn = [
//            TopLevelResource::make([
//                'label' => __('Įrašai'),
//                'expanded' => true,
//                'resources' => $mainResourcesOfMainMenu,
//            ]),
//        ];

        $groupsOfMenuItemsToReturn[] = TopLevelResource::make([
            'label' => __('Administravimas'),
            'expanded' => false,
            'resources' => [
                User::class,
                Role::class,
            ],
        ]);

        $toolsToReturn = [];

        $toolsToReturn[] = new CollapsibleResourceManager([
            'remember_menu_state' => true,
            'navigation' => $groupsOfMenuItemsToReturn,
        ]);

        $toolsToReturn[] = NovaPermissionTool::make()
            ->permissionPolicy(NovaPermissionPolicy::class)
            ->rolePolicy(NovaRolePolicy::class);

        return $toolsToReturn;
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
