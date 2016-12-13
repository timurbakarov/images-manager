<?php

namespace Tiix\ImageManager;

interface WebPathLocatorInterface
{
    /**
     * @return string
     */
    public function path($name);

    /**
     * @return string
     */
    public function relativePath($name);
}