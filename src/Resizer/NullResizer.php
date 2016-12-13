<?php

namespace Tiix\ImageManager\Resizer;

use Tiix\ImageManager\ResizerInterface;
use Tiix\ImageManager\StorageInterface;

class NullResizer implements ResizerInterface
{
    /**
     * @param StorageInterface $storage
     * @param $originalPath
     * @param $destinationPath
     * @param $width
     * @param null $height
     * @return string
     */
    public function resize(StorageInterface $storage, $name, $width, $height = null)
    {
        // TODO: Implement resize() method.
    }
}