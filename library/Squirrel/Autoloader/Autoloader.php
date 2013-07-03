<?php

namespace Squirrel\Autoloader;

use Squirrel\Finder\FinderInterface;
use Squirrel\Finder\Exception\PathNotFoundException;

/**
 * Abstract class for autoloaders allowing to register and unregister
 * current instance in SPL autoloaders.
 *
 * The autoloader uses a finder to search for files,
 * and supports an optional base classes directory.
 *
 * @package Squirrel\Autoloader
 * @author Valérian Galliat
 */
abstract class Autoloader implements AutoloaderInterface
{
    /**
     * @var FinderInterface
     */
    protected $finder;

    /**
     * @var string
     */
    protected $baseDirectory;

    /**
     * @param FinderInterface $finder Finder class to use.
     */
    public function __construct(FinderInterface $finder, $baseDirectory = null)
    {
        $this->finder = $finder;
        $this->baseDirectory = $baseDirectory;
    }

    /**
     * {@inheritdoc}
     */
    public function register($prepend = false)
    {
        spl_autoload_register(array($this, 'autoload'), true, $prepend);
    }

    /**
     * {@inheritdoc}
     */
    public function unregister()
    {
        spl_autoload_unregister(array($this, 'autoload'));
    }

    /**
     * {@inheritdoc}
     */
    public function autoload($className)
    {
        $path = $this->baseDirectory . '/' . $this->format($className);

        try {
            $fullPath = $this->finder->findFile($path);
        } catch (PathNotFoundException $exception) {
            return;
        }

        require $fullPath;
    }

    /**
     * Formats given class name to a valid filesystem path.
     * 
     * @param string $className
     * @return string
     */
    abstract protected function format($className);
}
