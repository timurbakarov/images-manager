<?php

namespace Tiix\ImageManager;

class Factory
{
    public static function buildDefault($storagePath, $webPath)
    {
        $storage = new \Tiix\ImageManager\Storage\LocalStorage($storagePath);
        $webPathLocator = new \Tiix\ImageManager\WebPathLocator\DefaultWebPathLocator($webPath);

        $resizedNamingStrategy = new \Tiix\ImageManager\ResizedNamingStrategy\DefaultResizedNamingStrategy();
        $resizer = new \Tiix\ImageManager\Resizer\InterventionResizer(
            new \Intervention\Image\ImageManager(),
            $resizedNamingStrategy
        );

        return new \Tiix\ImageManager\ImageManager(
            $storage,
            $webPathLocator,
            $resizer
        );
    }
}
