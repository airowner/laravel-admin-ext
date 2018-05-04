<?php

namespace Admin\Admin\Form\Field;

use Closure;
use Encore\Admin\Form\Field\File as BaseFile;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class File extends BaseFile
{
    private static $global_name_callback;

    public static function setGlobalNameCallback(Closure $func)
    {
        static::$global_name_callback = function($file){
            return $func($file);
        }
    }

    /**
     * Prepare for saving.
     *
     * @param UploadedFile|array $file
     *
     * @return mixed|string
     */
    public function prepare($file)
    {
        $this->name = $this->getStoreName($file);

        return $this->upload($file);
    }

    /**
     * Get store name of upload file.
     *
     * @param UploadedFile $file
     *
     * @return string
     */
    protected function getStoreName(UploadedFile $file)
    {
        if ($this->name instanceof Closure) {
            return $this->name->call($this, $file);
        }

        if (static::$global_name_callback instanceof Closure) {
            return static::$global_name_callback->call($this, $file);
        }

        if (is_string($this->name)) {
            return $this->name;
        }

        return $file->getClientOriginalName();
    }

    protected function upload(UploadedFile $file)
    {
        $path = $this->getDirectory() . '/' . $this->name;

        if(!$this->storage->exists($path)){
            $path = $this->storage->putFileAs($this->getDirectory(), $file, $this->name);
        }

        return $path;
    }


    // do not delete file
    public function destroy()
    {
    }
}
