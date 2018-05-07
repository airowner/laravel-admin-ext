<?php

namespace Airowner\Admin;

use Encore\Admin\Admin as BaseAdmin;
use Closure;
use Illuminate\Support\Facades\Route;

class Admin extends BaseAdmin
{
    /**
     * Register the auth routes.
     *
     * @return void
     */
    public function registerAuthRoutes()
    {
        $attributes = [
            'prefix'     => config('admin.route.prefix'),
            'namespace'  => 'Encore\Admin\Controllers',
            'middleware' => config('admin.route.middleware'),
        ];

        $domain = config('admin.route.domain');

        if($domain) {
            $attributes['domain'] = $domain;
        }

        Route::group($attributes, function ($router) {

            /* @var \Illuminate\Routing\Router $router */
            $router->group([], function ($router) {

                /* @var \Illuminate\Routing\Router $router */
                $router->resource('auth/users', 'UserController');
                $router->resource('auth/roles', 'RoleController');
                $router->resource('auth/permissions', 'PermissionController');
                $router->resource('auth/menu', 'MenuController', ['except' => ['create']]);
                $router->resource('auth/logs', 'LogController', ['only' => ['index', 'destroy']]);
            });

            $router->get('auth/login', 'AuthController@getLogin');
            $router->post('auth/login', 'AuthController@postLogin');
            $router->get('auth/logout', 'AuthController@getLogout');
            $router->get('auth/setting', 'AuthController@getSetting');
            $router->put('auth/setting', 'AuthController@putSetting');
        });
    }
}
