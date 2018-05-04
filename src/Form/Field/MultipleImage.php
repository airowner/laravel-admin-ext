<?php

namespace Airowner\Admin\Form\Field;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Encore\Admin\Form\Field\ImageField;

class MultipleImage extends MultipleFile
{
    use ImageField;

    /**
     * Prepare for each file.
     *
     * @param UploadedFile $image
     *
     * @return mixed|string
     */
    protected function prepareForeach(UploadedFile $image = null)
    {
        $this->name = $this->getStoreName($image);

        $this->callInterventionMethods($image->getRealPath());

        return tap($this->upload($image), function () {
            $this->name = null;
        });
    }
}
