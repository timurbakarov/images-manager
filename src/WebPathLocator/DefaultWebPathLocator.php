<?php

namespace Tiix\ImageManager\WebPathLocator;

use Tiix\ImageManager\WebPathLocatorInterface;

class DefaultWebPathLocator implements WebPathLocatorInterface
{
    /**
     * @var
     */
    private $domain;

    /**
     * @var
     */
    private $path;

    public function __construct($url)
    {
        $parts = parse_url($url);

        $this->domain = $this->normalizeDomain($parts);
        $this->path = isset($parts['path']) ? $this->normalizePath($parts['path']) : '';
    }

    /**
     * @return string
     */
    public function path($name)
    {
        return $this->domain . $this->relativePath($name);
    }

    /**
     * @return string
     */
    public function relativePath($name)
    {
        return '/' . $this->path . ltrim($name, '/');
    }

    /**
     * @param array $parts
     * @return string
     */
    protected function normalizeDomain(array $parts)
    {
        return $parts['scheme'] . '://' . rtrim($parts['host'], '/');
    }

    /**
     * @param $path
     * @return string
     */
    protected function normalizePath($path)
    {
        $path = trim($path, '/');

        if(!$path) {
            return '';
        }

        return $path . '/';
    }
}