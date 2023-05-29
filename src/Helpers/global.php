<?php

if(! function_exists('app'))
{
    /**
     * Creates a app instance
     *
     * @return \Visionv2\Core\App
     */
    function app()
    {
        return new \Visionv2\Core\App();
    }
}

if (!function_exists('dump'))
{
    /**
     * Dumps the values
     *
     * @param mixed values
     * @return \Vision\Helpers\Dumper
     */
    function dump(...$values)
    {
        return new Dumper(...$values);
    }
}

if (!function_exists('root_path'))
{
    /**
     * Get the root path
     *
     * @return string path
     */
    function root_path()
    {
        return App::getRootPath();
    }
}

if (!function_exists('view_path'))
{
    /**
     * Get the view path
     *
     * @return string path
     */
    function view_path()
    {
        return App::getViewPath();
    }
}

if (!function_exists('view'))
{
    /**
     * require the view component
     *
     * @return \Vision\Core\App
     */
    function view($view, $attributes = [])
    {
        return App::makeView($view, $attributes);
    }
}

if (!function_exists('config_path'))
{
    /**
     * Get the config path
     *
     * @return string path
     */
    function config_path()
    {
        return App::getConfigPath();
    }
}

if (!function_exists('routes_path'))
{
    /**
     * Get the routes path
     *
     * @return string path
     */
    function routes_path()
    {
        return App::getRoutesPath();
    }
}

if (!function_exists('env'))
{
    /**
     * Get a env value
     *
     * @param string item
     * @return string env
     */
    function env(string $item)
    {
        return Config\Handler::getEnv($item);
    }
}

if (!function_exists('config'))
{
    /**
     * Get a config value
     *
     * @param string item
     * @return string config
     */
    function config(string $key = null)
    {
        return Config\Handler::getConfig($key);
    }
}

if (!function_exists('abort'))
{
    /**
     * abort and show exception
     *
     * @param string value
     * @return ErrorException
     */
    function abort($message, $code = 500)
    {
        return new ErrorException($message, $code);
    }
}