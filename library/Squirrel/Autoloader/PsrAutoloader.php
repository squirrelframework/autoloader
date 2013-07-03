<?php

namespace Squirrel\Autoloader;

/**
 * Autoloader class using PSR-0 file naming conventions to find classes.
 *
 * @package Squirrel\Autoloader
 * @author Valérian Galliat
 */
class PsrAutoloader extends Autoloader
{
    /**
     * {@inheritdoc}
     */
    protected function format($className)
    {
        return implode('/', explode('\\', $className)) . '.php';
    }
}
