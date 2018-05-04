<?php

namespace Airowner\Admin;

use Encore\Admin\AdminServiceProvider as ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    protected $commands = [
        'Encore\Admin\Console\MakeCommand',
        'Encore\Admin\Console\MenuCommand',
        'Airowner\Admin\Console\InstallCommand',
        'Airowner\Admin\Console\UninstallCommand',
        'Encore\Admin\Console\ImportCommand',
    ];
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        if (file_exists($routes = base_path('routes/admin.php'))) {
            $this->loadRoutesFrom($routes);
        }
        parent::boot();
    }

}

