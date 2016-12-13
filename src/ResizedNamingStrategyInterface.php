<?php

namespace Tiix\ImageManager;

interface ResizedNamingStrategyInterface
{
    /**
     * @param $name
     * @param $width
     * @param $height
     * @return string
     */
    public function getName($name, $width, $height = null);
}