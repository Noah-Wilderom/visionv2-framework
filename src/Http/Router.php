<?php

namespace Visionv2\Http;

use Visionv2\Traits\Macroable;

class Router
{
    use Macroable;

    protected static array $routes;

    protected static $currentController;
    protected static $currentMethod;

    /**
     * @param array $routes
     */
    public function __construct(array $routes = [])
    {
        static::$routes = empty($routes) ? [] : $routes;
    }

    /**
     * @param $route
     * @param $controller
     * @return void
     */
    public static function get(string $route, $controller = false): void
    {
        static::$routes[$route] = [
            'controller' => $controller
                ? $controller[0]
                : static::$currentController,
            'method' => $controller
                ? $controller[1]
                : $controller
        ];
    }

    /**
     * @param string $controller
     * @return $this
     */
    public static function controller(string $controller): self
    {
        static::$currentController = $controller;

        return new static;
    }

    /**
     * @param $callback
     * @return callable
     */
    public static function group($callback): callable
    {
        return $callback();
    }

    /**
     * @return array
     */
    public static function getRoutes(): array
    {
        return static::$routes;
    }
}