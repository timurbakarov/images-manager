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
    public function outputPath($file = null)
    {
        return __DIR__ . '/_output' . ($file ? '/' . $file : '');
    }

    /**
     * @param null $file
     * @return string
     */
    public function dataPath($file = null)
    {
        return __DIR__ . '/_data' . ($file ? '/' . $file : '');
    }

    public function setUp()
    {
        $this->emptyDir($this->outputPath());
    }

    public function tearDown()
    {
        $this->emptyDir($this->outputPath());
    }
}