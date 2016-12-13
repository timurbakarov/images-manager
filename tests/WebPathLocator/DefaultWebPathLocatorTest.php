<?php

namespace Tests\Tiix\ImageManager\WebPathLocator;

use Tests\Tiix\ImageManager\TestCase;
use Tiix\ImageManager\WebPathLocator\DefaultWebPathLocator;

class DefaultWebPathLocatorTest extends TestCase
{
    /** @test */
    public function it_should_return_web_absolute_path()
    {
        $webPathLocator = new DefaultWebPathLocator('http://google.ru');
        $this->assertEquals('http://google.ru/image1.jpg', $webPathLocator->path('image1.jpg'));

        $webPathLocator = new DefaultWebPathLocator('http://google.ru/');
        $this->assertEquals('http://google.ru/image1.jpg', $webPathLocator->path('image1.jpg'));

        $webPathLocator = new DefaultWebPathLocator('http://google.ru/images');
        $this->assertEquals('http://google.ru/images/image1.jpg', $webPathLocator->path('image1.jpg'));

        $webPathLocator = new DefaultWebPathLocator('http://google.ru/images/');
        $this->assertEquals('http://google.ru/images/image1.jpg', $webPathLocator->path('image1.jpg'));
    }

    /** @test */
    public function it_should_return_relative_path()
    {
        $webPathLocator = new DefaultWebPathLocator('http://google.ru/images');
        $this->assertEquals('/images/image1.jpg', $webPathLocator->relativePath('image1.jpg'));
    }
}