<?php

namespace Tests\Tiix\ImageManager\Storage;

use Tests\Tiix\ImageManager\TestCase;
use Tiix\ImageManager\Storage\LocalStorage;

class LocalStorageTest extends TestCase
{
    /** @test */
    public function it_should_save_and_delete_image()
    {
        $storage = new LocalStorage($this->outputPath());

        $storage->save(file_get_contents(__DIR__ . '/../_data/image.jpg'), 'image.jpg');
        $this->assertFileExists($this->outputPath() . '/image.jpg');

        $storage->delete('image.jpg');
        $this->assertFileNotExists($this->outputPath() . '/image.jpg');
    }

    /** @test */
    public function it_should_save_with_renaming()
    {
        $storage = new LocalStorage($this->outputPath());

        $storage->save(file_get_contents(__DIR__ . '/../_data/image.jpg'), 'renamed-image.jpg');
        $this->assertFileExists($this->outputPath() . '/renamed-image.jpg');
    }

    /** @test */
    public function it_should_save_and_delete_image_with_subfolders()
    {
        $storage = new LocalStorage($this->outputPath());

        $storage->save(file_get_contents(__DIR__ . '/../_data/image.jpg'), 'subfolder/image.jpg');
        $this->assertFileExists($this->outputPath() . '/subfolder/image.jpg');

        $storage->delete('subfolder/image.jpg');
        $this->assertFileNotExists($this->outputPath() . '/subfolder/image.jpg');
        $this->assertFalse(is_dir($this->outputPath() . '/subfolder'));

        $storage->save(file_get_contents(__DIR__ . '/../_data/image.jpg'), 'subfolder/test/image.jpg');
        $this->assertFileExists($this->outputPath() . '/subfolder/test/image.jpg');

        $storage->delete('subfolder/test/image.jpg');
        $this->assertFileNotExists($this->outputPath() . '/subfolder/test/image.jpg');
        $this->assertFalse(is_dir($this->outputPath() . '/subfolder/test'));
        $this->assertFalse(is_dir($this->outputPath() . '/subfolder'));
    }

    /** @test */
    public function it_should_return_bool_if_resize_image_exists()
    {
        $storage = new LocalStorage($this->outputPath());
        $storage->save(file_get_contents(__DIR__ . '/../_data/image.jpg'), 'image.jpg');

        $this->assertTrue($storage->has('image.jpg'));
        $this->assertFalse($storage->has('image-not-exist.jpg'));
    }

    public function tearDown()
    {
        $this->emptyDir($this->outputPath());
    }
}