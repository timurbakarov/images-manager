<?php

namespace Tiix\ImageManager\Storage;

use DirectoryIterator;
use Tiix\ImageManager\StorageInterface;

class LocalStorage implements StorageInterface
{
    /**
     * @var
     */
    private $path;

    public function __construct($path)
    {
        $this->path = rtrim($path, '/') . '/';

        if(!is_dir($this->path)) {
            mkdir($this->path, 0755, true);
        }
    }

    /**
     * @param $content
     * @param null $imageName
     * @return $this
     */
    public function save($content, $name)
    {
        $destination = $this->path . $name;
        $destinationPath = pathinfo($destination, PATHINFO_DIRNAME);

        if(file_exists($destination)) {
            $this->removeResized($destination);
        }

        if(!is_dir($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        file_put_contents($this->path . $name, $content);

        return $this;
    }

    /**
     * @param $name
     * @return string
     */
    public function get($name)
    {
        return file_get_contents($this->path . $name);
    }

    /**
     * @param $name
     * @return bool
     */
    public function has($name)
    {
        return file_exists($this->path . $name);
    }

    /**
     * @return mixed
     */
    public function delete($name)
    {
        if(strpos($name, '/') !== false) {
            list($dir) = explode('/', $name);

            $this->emptyDir($this->path . $dir);

            rmdir($this->path . $dir);
        } else {
            if(file_exists($this->path . $name)) {
                unlink($this->path . $name);
            }
        }

        return $this;
    }

    /**
     * @param $dir
     */
    protected function emptyDir($dir)
    {
        foreach (new DirectoryIterator($dir) as $fileInfo) {
            if(!$fileInfo->isDot()) {
                if($fileInfo->isDir()) {
                    $this->emptyDir($fileInfo->getPathname());
                    rmdir($fileInfo->getPathname());
                } elseif(substr($fileInfo->getFilename(), 0, 1) != '.') {
                    unlink($fileInfo->getPathname());
                }
            }
        }
    }

    /**
     * @param $destination
     * @return $this
     */
    private function removeResized($destination)
    {
        $pathinfo = pathinfo($destination);

        foreach(glob($pathinfo['dirname'] . '/' . $pathinfo['filename'] .'_*.' . $pathinfo['extension']) as $file) {
            unlink($file);
        }

        return $this;
    }
}