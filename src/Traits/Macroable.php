<?php

namespace Visionv2\Traits;

use Closure;
use ReflectionClass;
use ReflectionMethod;
use BadMethodCallException;

trait Macroable
{


    protected static $macros = [];

    public static function macro($name, $macro)
    {
        static::$macros[$name] = $macro;
    }

    public static function hasMacro($method)
    {
        return isset(static::$macros[$method]);
    }

    public static function invokeClass($class, $replace = true)
    {
        $methods = (new ReflectionClass($class))->getMethods(
            ReflectionMethod::IS_PUBLIC | ReflectionMethod::IS_PROTECTED
        );

        foreach ($methods as $method)
        {
            if ($replace || !static::hasMacro($method->name))
            {
                $method->setAccessible(true);
                static::macro($method->name, $method->invoke($class));
            }
        }
    }

    public static function __callStatic($method, $arguments)
    {
        if (!static::hasMacro($method))
        {
            throw new BadMethodCallException(sprintf(
                'Method %s::%s does not exist.',
                static::class,
                $method
            ));
        }

        $macro = static::$macros[$method];

        if ($macro instanceof Closure)
        {
            $macro = $macro->bindTo(null, static::class);
        }

        return $macro(...$arguments);
    }

    public function __call($method, $arguments)
    {
        if (!static::hasMacro($method))
        {
            throw new BadMethodCallException(sprintf(
                'Method %s::%s does not exist.',
                static::class,
                $method
            ));
        }

        $macro = static::$macros[$method];

        if ($macro instanceof Closure)
        {
            $macro = $macro->bindTo($this, static::class);
        }

        return $macro(...$arguments);
    }
}