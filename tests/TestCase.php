<?php

namespace Tests\Tiix\ImageManager;

use DirectoryIterator;

class TestCase extends \PHPUnit_Framework_TestCase
{
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
     * @return string
     */
    public function outputPath()
    {
        return __DIR__ . '/_output';
    }
}