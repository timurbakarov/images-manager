<?php

namespace Tests\Tiix\ImageManager\Resizer;

use Intervention\Image\ImageManager;
use Tests\Tiix\ImageManager\TestCase;
use Tiix\ImageManager\ResizedNamingStrategy\DefaultResizedNamingStrategy;
use Tiix\ImageManager\Resizer\InterventionResizer;
use Tiix\ImageManager\Storage\LocalStorage;

class InterventionResizerTest extends TestCase
{
    /** @test */
    public function it_should_resize_image()
    {
        $storage = new LocalStorage($this->outputPath());
        $storage->save(file_get_contents(__DIR__ . '/../_data/image.jpg'), 'image.jpg');

        $resizer = new InterventionResizer(new ImageManager(), new DefaultResizedNamingStrategy());
        $resizeImageName = $resizer->resize($storage, 'image.jpg', 120, 150);

        $this->assertTrue($storage->has($resizeImageName));

        $size = getimagesize($this->outputPath() . '/' . $resizeImageName);

        $this->assertEquals(120, $size[0]);
        $this->assertEquals(150, $size[1]);
    }

    public function tearDown()
    {
        $this->emptyDir($this->outputPath());
    }
}