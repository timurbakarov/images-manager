<?php

namespace Tiix\ImageManager\Resizer;

use Intervention\Image\ImageManager;
use Tiix\ImageManager\ResizedNamingStrategyInterface;
use Tiix\ImageManager\ResizerInterface;
use Tiix\ImageManager\StorageInterface;

class InterventionResizer implements ResizerInterface
{
    /**
     * @var ImageManager
     */
    private $imageManager;

    /**
     * @var ResizedNamingStrategyInterface
     */
    private $resizedNamingStrategy;

    public function __construct(ImageManager $imageManager, ResizedNamingStrategyInterface $resizedNamingStrategy)
    {
        $this->imageManager = $imageManager;
        $this->resizedNamingStrategy = $resizedNamingStrategy;
    }

    /**
     * @param $path
     * @param $width
     * @param $height
     * @return mixed
     */
    public function resize(StorageInterface $storage, $name, $width, $height = null)
    {
        $resizedImageName = $this->resizedNamingStrategy->getName($name, $width, $height);

        if($storage->has($resizedImageName)) {
            return $resizedImageName;
        }

        $content = $storage->get($name);

        $image = $this->imageManager
            ->make($content)
            ->fit($width, $height);

        $storage->save($image->encode(null, 100), $resizedImageName);

        return $resizedImageName;
    }
}