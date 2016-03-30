<?php
namespace Kernel;

use ReflectionClass;
use ReflectionFunction;
use ReflectionFunctionAbstract;
use ReflectionMethod;
use RuntimeException;

/**
 * An dependency injection container used to resolve dependencies and create objects
 *
 * THIS IS FOR EDUCATIONAL PURPOSE ONLY AND HAS NOT BEEN TESTED IN PRODUCTION!
 *
 * Usage:
 *
 *      $container = new Container();
 *
 *      // Bind a factory function to a class
 *      $container->bind('Foo', function () { return new Foo(); });
 *
 *      // Bind arguments to the constructor of a class
 *      $container->bindArguments('Bar', ['name' => 'Bar', 'age' => 63]);
 *
 *      // Bind an instance to a class
 *      $container->bindInstance('Tar', new Tar());
 *
 *      // Get a new or existing instance of a class depending on how it was binded
 *      $foo = $container->get('Foo');
 *
 *      // Call a function and resolve it's parameters
 *      $result = $container->call([$foo, 'method'], ['unresolvable' => 'argument']);
 */
class Container
{
    /**
     * @var mixed[][]
     */
    private $arguments = [];

    /**
     * @var callable[]
     */
    private $factories = [];

    /**
     * @var mixed[]
     */
    private $instances = [];

    /**
     * @var bool[]
     */
    private $singletons = [];

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->instances[__CLASS__] = $this;
    }

    /**
     * Binds a factory function to a class
     *
     * @param string $class  Fully qualified class name
     * @param callable $factory  Function that returns an instance of $class
     * @param bool $singleton  Set to true if you want the same object returned every time
     */
    public function bind($class, callable $factory, $singleton = false)
    {
        $this->factories[$class] = $factory;

        if ($singleton) {
            $this->singleton[$class] = true;
        }
    }

    /**
     * Binds a list of arguments to a class
     *
     * @param string $class  Fully qualified class name
     * @param mixed[] $arguments  Arguments to be passed to $class's constructor
     * @param bool $singleton  Set to true if you want the same object returned every time
     */
    public function bindArguments($class, $arguments, $singleton = false)
    {
        $this->arguments[$class] = $arguments;

        if ($singleton) {
            $this->singleton[$class] = true;
        }
    }

    /**
     * Binds an instance to a class
     *
     * @param string $class  Fully qualified class name
     * @param mixed $instance  An instance of $class
     */
    public function bindInstance($class, $instance)
    {
        $this->instances[$class] = $instance;
    }

    /**
     * Gets an instance of $class
     *
     * @param string $class  Fully qualified class name
     * @return mixed  An instance of $class
     */
    public function get($class)
    {
        if (isset($this->instances[$class])) {
            $object = $this->instances[$class];

        } else {
            if (isset($this->factories[$class])) {
                $object = call_user_func($this->factories[$class]);
            } else {
                $object = $this->create($class);
            }

            if (isset($this->singleton[$class])) {
                $this->instances[$class] = $object;
            }
        }

        return $object;
    }

    /**
     * Calls a method or function and returns the output
     *
     * @param callable $callable  The method of function to be called
     * @param mixed[] $arguments  Arguments to be passed to $callable
     * @return mixed  Output from $callable
     */
    public function call(callable $callable, array $arguments = [])
    {
        if (is_array($callable)) {
            $method = new ReflectionMethod($callable[0], $callable[1]);
        } else {
            $method = new ReflectionFunction($callable);
        }

        $arguments = $this->resolveParameters($method, $arguments);

        return call_user_func_array($callable, $arguments);
    }

    /**
     * Creates a new instance of $class
     *
     * @param string $class  Fylly qualified class name
     * @param mixed[] $arguments  Arguments to be passed to $class's constructor
     * @return mixed  An instance of $class
     */
    public function create($class, array $arguments = [])
    {
        $reflection = new ReflectionClass($class);

        if ($method = $reflection->getConstructor()) {
            if (isset($this->arguments[$class])) {
                $arguments = array_merge($this->arguments[$class], $arguments);
            }

            if ($arguments = $this->resolveParameters($method, $arguments)) {
                return $reflection->newInstanceArgs($arguments);
            }
        }

        return new $class();
    }

    /**
     * Returns the arguments for a method or function by looking at type hinting, $arguments and default values
     *
     * @param ReflectionFunctionAbstract $method  The method or function to look at
     * @param mixed[] $arguments  Arguments to be passed to $method. Can be indexed by name or unresolved number
     * @return mixed[]  The resolved arguments
     */
    private function resolveParameters(ReflectionFunctionAbstract $method, array $provided = [])
    {
        $arguments = [];
        $i = 0;

        foreach ($method->getParameters() as $parameter) {

            if (isset($provided[$parameter->name])) {
                $arguments[] = $provided[$parameter->name];

            } elseif (isset($provided[$i])) {
                $arguments[] = $provided[$i];
                $i++;

            } elseif ($type = $parameter->getClass()) {
                $arguments[] = $this->get($type->name);

            } elseif ($parameter->isDefaultValueAvailable()) {
                $arguments[] = $parameter->getDefaultValue();

            } elseif ($parameter->isOptional()) {
                break;

            } else {
                throw new RuntimeException('Unable to resolve parameter "$' . $parameter->name . '" of ' . (string)$method);
            }
        }

        return $arguments;
    }
}
