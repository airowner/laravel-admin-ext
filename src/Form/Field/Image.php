<?php

namespace Airowner\Admin\Form\Field;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Encore\Admin\Form\Field\ImageField;

class Image extends File
{
    use ImageField;

    /**
     * @param array|UploadedFile $image
     *
     * @return string
     */
    public function prepare($image)
    {
        $this->name = $this->getStoreName($image);

        $this->callInterventionMethods($image->getRealPath());

        return $this->upload($image);
    }
}
