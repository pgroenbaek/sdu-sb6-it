<?php
namespace Kernel;

/**
 * A basic autoloader class that follows the PSR-4 standard
 *
 * THIS IS FOR EDUCATIONAL PURPOSE ONLY AND HAS NOT BEEN TESTED IN PRODUCTION!
 *
 * Usage:
 *
 *      $loader = new Autoloader();
 *      $loader->register();
 *
 *      $loader->addNamespace('My\Namespace\Prefix', '/full/path/to/files');
 *      $loader->addNamespace('My\Namespace\Prefix', '/different/path');
 *      $loader->addNamespace('My\Project', 'relative/path');
 */
class Autoloader
{
    /**
     * @var string[][]  <namespace\prefix> => [<base/directory>, ...]
     */
    private $prefixes = [];

    /**
     * Registers this instance as an autoloader
     *
     * @param bool $prepend
     * @return bool
     */
    public function register($prepend = false)
    {
        return spl_autoload_register([$this, 'loadClass'], false, $prepend);
    }

    /**
     * Links a base directory to a namespace prefix
     *
     * @param string $prefix  No leading or trailing "\"
     * @param string $baseDir  No trailing "/"
     */
    public function addNamespace($prefix, $baseDir)
    {
        $this->prefixes[$prefix][] = $baseDir;
    }

    /**
     * Loads a class based on the prefix/base directory configuration
     *
     * @param string $class  Fully qualified class name
     */
    public function loadClass($class)
    {
        $prefix = $class;

        while ($position = strrpos($prefix, '\\')) {
            $prefix = substr($class, 0, $position);

            if (!isset($this->prefixes[$prefix])) {
                continue;
            }

            foreach ($this->prefixes[$prefix] as $baseDir) {
                $relativeClass = substr($class, $position);
                $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

                if (file_exists($file)) {
                    autoloaderInclude($file);
                }
            }
        }
    }
}

/**
 * Scope isolated include - prevents access to $this/self from included files
 *
 * @param string $file
 */
function autoloaderInclude($file)
{
    require $file;
}
