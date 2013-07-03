<?php

namespace Squirrel\Autoloader;

/**
 * Interface for autoloader classes.
 *
 * @package Squirrel\Autoloader
 * @author Valérian Galliat
 */
interface AutoloaderInterface
{
    /**
     * Registers autoloader instance.
     *
     * @param boolean $prepend Whether to prepend the autoloader or not.
     */
    public function register($prepend = false);

    /**
     * Unregisters autoloader instance.
     */
    public function unregister();

    /**
     * Loads a class or an interface from a file using its fully qualified name.
     *
     * @param string $className Name of the class to load.
     */
    public function autoload($className);
}
