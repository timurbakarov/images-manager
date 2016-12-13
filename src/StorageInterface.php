<?php

namespace Tiix\ImageManager;

interface StorageInterface
{
    /**
     * @param $content
     * @param $name
     * @return mixed
     */
    public function save($content, $name);

    /**
     * @param $name
     * @return mixed
     */
    public function get($name);

    /**
     * @param $name
     * @return mixed
     */
    public function delete($name);

    /**
     * @param $name
     * @return bool
     */
    public function has($name);
}