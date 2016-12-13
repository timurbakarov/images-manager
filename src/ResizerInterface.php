<?php

namespace Tiix\ImageManager;

interface ResizerInterface
{
    /**
     * @param StorageInterface $storage
     * @param $originalPath
     * @param $destinationPath
     * @param $width
     * @param null $height
     * @return string
     */
    public function resize(StorageInterface $storage, $name, $width, $height = null);
}