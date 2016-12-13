<?php

namespace Tiix\ImageManager\WebPathLocator;

use Tiix\ImageManager\WebPathLocatorInterface;

class NullWebPathLocator implements WebPathLocatorInterface
{
    /**
     * @return mixed
     */
    public function path($name)
    {

    }

    /**
     * @return mixed
     */
    public function relativePath($name)
    {

    }
}