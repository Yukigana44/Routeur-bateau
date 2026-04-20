<?php

namespace App;

class Router
{
    private array $routes = [];

    public function get(string $path, callable $handler): void
    {
        $this->addRoute('GET', $path, $handler);
    }

    public function post(string $path, callable $handler): void
    {
        $this->addRoute('POST', $path, $handler);
    }

    private function addRoute(string $method, string $path, callable $handler): void
    {
        $pattern = preg_replace_callback(
            '/\{(\w+)\}/',
            fn ($matches) => '(?P<' . $matches[1] . '>[^/]+)',
            trim($path, '/')
        );

        $this->routes[$method][] = [
            'path' => $path,
            'pattern' => '#^/' . ($pattern === '' ? '' : $pattern) . '/?$#',
            'handler' => $handler,
        ];
    }

    public function dispatch(string $method, string $uri): void
    {
        $path = parse_url($uri, PHP_URL_PATH) ?: '/';

        if ($route = $this->matchRoute($method, $path)) {
            call_user_func($route['handler'], $route['params']);
            return;
        }

        header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
        echo '<h1>404 - Page non trouvée</h1>';
    }

    private function matchRoute(string $method, string $path): array|false
    {
        $routes = $this->routes[$method] ?? [];

        foreach ($routes as $route) {
            if (preg_match($route['pattern'], $path, $matches)) {
                $params = array_filter(
                    $matches,
                    fn ($key) => !is_int($key),
                    ARRAY_FILTER_USE_KEY
                );

                return ['handler' => $route['handler'], 'params' => $params];
            }
        }

        return false;
    }
}
