<?php

namespace Tests\Tiix\ImageManager;

use Tiix\ImageManager\Factory;
use Tiix\ImageManager\ImageManager;
use Tiix\ImageManager\Resizer\NullResizer;
use Tiix\ImageManager\Storage\NullStorage;
use Tiix\ImageManager\WebPathLocator\NullWebPathLocator;

class ImageManagerTest extends TestCase
{
    /** @test */
    public function it_should()
    {
        $imageManager = new ImageManager(
            new NullStorage(),
            new NullWebPathLocator(),
            new NullResizer()
        );

        $this->assertEquals($imageManager, $imageManager->save('test/test.jpg', 'test.jpg'));
        $this->assertEquals($imageManager, $imageManager->delete('test.jpg'));
        $this->assertNull($imageManager->webPath('test.jpg'));
        $this->assertNull($imageManager->relativeWebPath('test.jpg'));
    }

    /** @test */
    public function it_should_build_default_instance()
    {
        $imageManager = Factory::buildDefault($this->outputPath(), 'http://example.com');


        $imageManager->save(file_get_contents($this->dataPath('image.jpg')), 'test.jpg');
        $this->assertFileExists($this->outputPath('test.jpg'));
    }
}