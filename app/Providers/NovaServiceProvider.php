<?php

namespace App\Providers;

use App\Nova\Bus;
use App\Nova\BusFeature;
use App\Nova\BusRent;
use App\Nova\BusType;
use App\Nova\Customer;
use App\Nova\Role;
use App\Nova\Route;
use App\Nova\Trip;
use App\Nova\User;
use DigitalCreative\CollapsibleResourceManager\CollapsibleResourceManager;
use DigitalCreative\CollapsibleResourceManager\Resources\Group;
use DigitalCreative\CollapsibleResourceManager\Resources\TopLevelResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Vyuldashev\NovaPermission\NovaPermissionTool;
use Vyuldashev\NovaPermission\Permission;

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

        return [
            new CollapsibleResourceManager([
                'remember_menu_state' => true,
                'navigation' => [
                    TopLevelResource::make([
                        'label' => __('Sistema'),
                        'resources' => [
                            Group::make([
                                'label' => __('Organizavimas'),
                                'expanded' => false,
                                'resources' => [
                                    Route::class,
                                    Trip::class,
                                ]
                            ]),
                            Group::make([
                                'label' => __('Transportas'),
                                'expanded' => false,
                                'resources' => [
                                    Bus::class,
                                    BusFeature::class,
                                    BusType::class
                                ]
                            ]),
                            Group::make([
                                'label' => __('Nuoma'),
                                'expanded' => false,
                                'resources' => [
                                    BusRent::class
                                ]
                            ]),
                            Group::make([
                                'label' => __('Kelionės'),
                                'expanded' => false,
                                'resources' => []
                            ]),
                            Group::make([
                                'label' => __('Paskyros'),
                                'expanded' => false,
                                'resources' => [
                                    Customer::class,
                                    User::class,
                                ]
                            ]),
                            Group::make([
                                'label' => __('Kita'),
                                'expanded' => false,
                                'resources' => []
                            ])->canSee(function (Request $request) {
                                return !$request->user()->hasAnyPermission(['Hide Sliders']);
                            }),
                            Group::make([
                                'label' => __('Roles and permissions'),
                                'expanded' => false,
                                'resources' => [
                                    Role::class,
                                    Permission::class,
                                ]
                            ])->canSee(function (Request $request) {
                                return !$request->user()->hasPermissionTo(\Spatie\Permission\Models\Permission::query()->find(3));
                            }),
                        ]
                    ]),
                ]
            ]),
//            (new SettingsTool)->canSee(function (Request $request) {
//                return !$request->user()->hasPermissionTo(\Spatie\Permission\Models\Permission::query()->find(2));
//            }),
            NovaPermissionTool::make(),
        ];
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
