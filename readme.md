# Image manager

## Installation

```bash
composer require tiix/image-manager
```

## Usage

```php
$storage = new \Tiix\ImageManager\Storage\LocalStorage('/path/to/storage');
$webPathLocator = new \Tiix\ImageManager\WebPathLocator\DefaultWebPathLocator('http://google.ru/path/');

$resizedNamingStrategy = new \Tiix\ImageManager\ResizedNamingStrategy\DefaultResizedNamingStrategy();
$resizer = new \Tiix\ImageManager\Resizer\InterventionResizer(
    new \Intervention\Image\ImageManager(), 
    $resizedNamingStrategy
);

$imagesManager = new \Tiix\ImageManager\ImageManager(
     $storage,
     $webPathLocator,
     $resizer
 );
 
// saving image
$imagesManager->save(file_get_contents('path/to/image.jpg'), 'image-name.jpg');

// get web path to image
echo $imagesManager->webPath('image-name.jpg'); // http://google.ru/path/image-name.jpg

// get relative path to image
echo $imagesManager->webPath('image-name.jpg'); // /path/image-name.jpg

// get resized web path to image
echo $imagesManager->webPathResized('image-name.jpg', 100, 100); // http://google.ru/path/image-name100x100.jpg

// get resized relative path to image
echo $imagesManager->relativeWebPathResized('image-name.jpg', 100, 100); // /path/image-name100x100.jpg
```