<?php

namespace Airowner\Admin\Console;

use Encore\Admin\Console\InstallCommand as Command;

class InstallCommand extends Command
{
    /**
     * Create routes file.
     *
     * @return void
     */
    protected function createRoutesFile()
    {
        $file = base_path('routes/admin.php');

        $contents = $this->getStub('routes');
        $this->laravel['files']->put($file, str_replace('DummyNamespace', config('admin.route.namespace'), $contents));
        $this->line('<info>Routes file was created:</info> '.str_replace(base_path(), '', $file));
    }

    /**
     * Get stub contents.
     *
     * @param $name
     *
     * @return string
     */
    protected function getStub($name)
    {
        $path = __DIR__."/stubs/$name.stub";
        if(file_exists($path)) {
            return $this->laravel['files']->get($path);
        }else{
            return parent::getStub($name);
        }
    }
}
