<?php

namespace Airowner\Admin\Console;

use Encore\Admin\Console\UninstallCommand as Command;

class UninstallCommand extends Command
{
    /**
     * Remove files and directories.
     *
     * @return void
     */
    protected function removeFilesAndDirectories()
    {
        parent::removeFilesAndDirectories();
        $this->laravel['files']->delete(base_path('routes/admin.php'));
    }
}

