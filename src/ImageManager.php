<?php

namespace Tiix\ImageManager;

class ImageManager implements ImageManagerInterface
{
    /**
     * @var StorageInterface
     */
    private $storage;

    /**
     * @var WebPathLocatorInterface
     */
    private $webPathLocator;

    /**
     * @var ResizerInterface
     */
    private $resizer;

    /**
     * ImageManager constructor.
     *
     * @param StorageInterface $storage
     * @param WebPathLocatorInterface $webPathLocator
     * @param ResizerInterface $resizer
     */
    public function __construct(
        StorageInterface $storage,
        WebPathLocatorInterface $webPathLocator,
        ResizerInterface $resizer
    ) {
        $this->storage = $storage;
        $this->webPathLocator = $webPathLocator;
        $this->resizer = $resizer;
    }
    
    /**
     * @return mixed
     */
    public function save($path, $name)
    {
        $this->storage->save($path, $name);

        return $this;
    }

    /**
     * @return mixed
     */
    public function delete($name)
    {
        $this->storage->delete($name);

        return $this;
    }

    /**
     * @return mixed
     */
    public function webPath($name)
    {
        return $this->webPathLocator->path($name);
    }

    /**
     * @return mixed
     */
    public function relativeWebPath($name)
    {
        return $this->webPathLocator->relativePath($name);
    }

    /**
     * @param $name
     * @param $width
     * @param null $height
     * @return mixed
     */
    public function webPathResized($name, $width, $height = null)
    {
        return $this->webPathLocator->path($this->resizer->resize($this->getStorage(), $name, $width, $height));
    }

    /**
     * @return mixed
     */
    public function relativeWebPathResized($name, $width, $height = null)
    {
        return $this->webPathLocator->relativePath($this->resizer->resize($this->getStorage(), $name, $width, $height));
    }

    /**
     * @return StorageInterface
     */
    public function getStorage()
    {
        return $this->storage;
    }

    /**
     * @return ResizerInterface
     */
    public function getResizer()
    {
        return $this->resizer;
    }

    /**
     * @return WebPathLocatorInterface
     */
    public function getWebPathLocator()
    {
        return $this->webPathLocator;
    }
}