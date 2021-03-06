<?php

namespace Tiix\ImageManager\ResizedNamingStrategy;

use Tiix\ImageManager\ResizedNamingStrategyInterface;
use Tiix\ImageManager\Exceptions\InvalidArgumentException;

class DefaultResizedNamingStrategy implements ResizedNamingStrategyInterface
{
    /**
     * @param $name
     * @param $width
     * @param $height
     * @return string
     */
    public function getName($name, $width, $height = null)
    {
        if(!is_int($width)) {
            throw new InvalidArgumentException('Invalid argument width. It should be integer');
        }

        $pathinfo = pathinfo($name);

        $directory = $pathinfo['dirname'] == '.' ? '' : $pathinfo['dirname'] . '/';

        $height = $height ? 'x' . $height : '';

        return sprintf('%s%s_%s%s.%s', $directory, $pathinfo['filename'], $width, $height, $pathinfo['extension']);
    }
}