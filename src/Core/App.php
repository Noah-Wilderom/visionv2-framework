<?php

namespace Visionv2\Core;

use Visionv2\Console\Kernel;
use Visionv2\Traits\Macroable;

class App
{
    use Macroable;

    private static $basePath;
    private static \Visionv2\Config\Handler $config;
    private Kernel $kernel;

    public function __construct()
    {
        static::init();
    }

    public static function init(): void
    {
        // Define the absolute path off the project directory
        static::$basePath = dirname(dirname(dirname(dirname(dirname(__DIR__)))));
    }

    public function prepare($path): App
    {
        return $this;
    }

    public function build()
    {
        //Initialize the Config handler
        static::$config = new Config\Handler;

        // Initialize the Request
        $this->request = new Request();

        return $this->setRouting();
    }

    private function setRouting()
    {
        require root_path() . DIRECTORY_SEPARATOR . 'routes.php';

        $routes = Route::getRoutes();
        $uri = $this->getURL();

        // print_r($routes);
        // print_r("<br>");

        if (isset($routes[$uri]))
        {
            $route = $routes[$uri];

            $obj = new $route['controller'];

            $method = new ReflectionMethod($obj, $route['method']);
            foreach ($method->getParameters() as $arg)
            {
//                if ($arg->getType() instanceof Route)
//                {
//                    return $obj->{$route['method']}($this->request);
//                }
            }

            return $obj->{$route['method']}();
        }

        abort(404);
    }

    public function buildKernel($args): void
    {
        //Initialize the Config handler
        static::$config = new \Visionv2\Config\Handler;

        $this->kernel = new Kernel();

        array_shift($args);

        if (empty($args))
        {
            $this->kernel->help();
            return;
        }
    }

    public static function getRootPath(): string
    {
        return static::$basePath;
    }

    public static function getConfigPath(): string
    {
        return static::$basePath . DIRECTORY_SEPARATOR . 'config';
    }

    public static function getRoutesPath(): string
    {
        return static::$basePath . DIRECTORY_SEPARATOR . 'routes';
    }

    public static function getViewPath(): string
    {
        return static::$basePath . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR;
    }

    public static function makeView($view, $attributes = [])
    {
        extract($attributes);

        require_once view_path() . $view . '.php';
    }

    public function getURL()
    {
        if ($_SERVER['REQUEST_URI'])
        {
            $url = rtrim(strtolower($_SERVER['REQUEST_URI']), '/');
            // Filter de url van alles wat niet in een url thuishoort
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return $url;
        }
    }
}