<?php

namespace Tiix\ImageManager;

interface ImageManagerInterface
{
    /**
     * @return mixed
     */
    public function save($path, $name);

    /**
     * @return mixed
     */
    public function delete($name);

    /**
     * @return mixed
     */
    public function webPath($name);

    /**
     * @return mixed
     */
    public function relativeWebPath($name);

    /**
     * @param $name
     * @param $width
     * @param null $height
     * @return mixed
     */
    public function webPathResized($name, $width, $height = null);

    /**
     * @param $name
     * @param $width
     * @param null $height
     * @return mixed
     */
    public function relativeWebPathResized($name, $width, $height = null);
}