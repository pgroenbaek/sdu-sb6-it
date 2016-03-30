<?php
namespace Kernel;

use RuntimeException;

/**
 * A simple router that can match a uri against a set of route patterns and extract relevant arguments
 *
 * THIS IS FOR EDUCATIONAL PURPOSE ONLY AND HAS NOT BEEN TESTED IN PRODUCTION!
 *
 * Usage:
 *
 *      $router = new Router();
 *
 *      $router->addRoute('GET', '/', 'root');
 *      $router->addRoute('GET', '/article/{name}[/{page:\d+}]', 'article');
 *      $router->addRoute('POST', '/api', ['Controller', 'method']);
 *
 *      $uri = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
 *      $route = $router->match($_SERVER['REQUEST_METHOD'], $uri);
 */
class Router
{
    /**
     * @var string[][]  <request method> => [<route regex>, ...]
     */
    private $routes = [];

    /**
     * @var mixed[][][]  <request method> => [['handle' => <mixed>, 'parameters' => [<mixed>, ...]], ...]
     */
    private $info = [];

    /**
     * Add a route pattern to match against
     *
     * @param string $method  GET, POST, PUT, ...
     * @param string $pattern  /article/{name}[/{page:\d+}]
     * @param mixed $handle  Anything you want. It is passed straight through
     */
    public function addRoute($method, $pattern, $handle)
    {
        // [1]: Parameter name
        // [2]: Custom regex
        // [3]: Plain text
        $parseRegex = '/(?:\\{([a-zA-Z][a-zA-Z0-9_]*)(?:\\:((?:\\{[0-9,]+\\}|[^}])+))?\\}|([^{]+))/';
        $routeRegex = '';
        $parameters = [];

        preg_match_all($parseRegex, $pattern, $matches, PREG_SET_ORDER);

        foreach ($matches as $match) {
            if (isset($match[3])) {
                $routeRegex .= strtr($match[3], ['[' => '(?:', ']' => ')?']);
            } else {
                $parameters[] = $match[1];
                $routeRegex .= isset($match[2]) ? "({$match[2]})" : '([^/]+)';
            }
        }

        $this->routes[$method][] = '~^' . strtr($routeRegex, ['~' => '\\~']) . '$~';
        $this->info[$method][] = [
            'handle' => $handle,
            'parameters' => $parameters
        ];
    }

    /**
     * Match a uri against added route patterns
     *
     * @param string $method  The request method
     * @param string $uri  The requested uri
     * @return mixed[]  ['handle' => <mixed>, 'arguments' => [<mixed>, ...]]
     */
    public function match($method, $uri)
    {
        foreach ($this->routes[$method] as $i => $regex) {
            if (preg_match($regex, $uri, $matches)) {
                $info = $this->info[$method][$i];
                $arguments = [];
                $index = 1;

                foreach ($info['parameters'] as $name) {
                    if (!isset($matches[$index])) {
                        break;
                    }

                    $arguments[$name] = $matches[$index];
                    $index++;
                }

                return [
                    'handle' => $info['handle'],
                    'arguments' => $arguments
                ];
            }
        }
    }
}
