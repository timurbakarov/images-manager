<?php

namespace Tiix\ImageManager\Storage;

use Tiix\ImageManager\StorageInterface;

class NullStorage implements StorageInterface
{
    /**
     * @param $path
     * @param null $imageName
     * @return $this
     */
    public function save($path, $imageName = null)
    {
        return $this;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function delete($name)
    {
        return $this;
    }

    /**
     * @param $name
     * @return bool
     */
    public function has($name)
    {
        // TODO: Implement has() method.
    }

    /**
     * @param $name
     * @return mixed
     */
    public function get($name)
    {
        // TODO: Implement get() method.
    }
}