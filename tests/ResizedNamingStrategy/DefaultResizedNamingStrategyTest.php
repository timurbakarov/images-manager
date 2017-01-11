<?php

namespace Tests\Tiix\ImageManager\ResizedNamingStrategy;

use Tests\Tiix\ImageManager\TestCase;
use Tiix\ImageManager\ResizedNamingStrategy\DefaultResizedNamingStrategy;

class DefaultResizedNamingStrategyTest extends TestCase
{
    /** @test */
    public function it_should_return_name_for_resized_image()
    {
        $strategy = new DefaultResizedNamingStrategy();

        $name = 'image.jpg';
        $this->assertEquals('image_100x150.jpg', $strategy->getName($name, 100, 150));
    }

    /** @test */
    public function it_should_return_name_for_resized_image_with_subfolders()
    {
        $strategy = new DefaultResizedNamingStrategy();

        $name = 'subfolder/image.jpg';
        $this->assertEquals('subfolder/image_100x150.jpg', $strategy->getName($name, 100, 150));
    }

    /** @test */
    public function it_should_return_name_for_resized_image_without_height()
    {
        $strategy = new DefaultResizedNamingStrategy();

        $name = 'image.jpg';
        $this->assertEquals('image_100.jpg', $strategy->getName($name, 100));
    }
}