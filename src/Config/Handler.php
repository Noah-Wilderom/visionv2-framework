<?php

namespace Visionv2\Config;

use Dotenv\Dotenv;
use InvalidArgumentException;
use Vision\Helpers\Directory;
use Symfony\Component\Finder\Finder;

class Handler
{

    protected static $env;
    protected static $dotEnvDriver;

    protected static $config = [];

    public function __construct()
    {
        static::$env = $this->initEnv();
        $this->initConfig();
    }

    private function initEnv(): array
    {
        self::$dotEnvDriver = Dotenv::createImmutable(root_path());
        self::$dotEnvDriver->safeLoad();

        return static::setEnv();
    }

    private static function setEnv(): array
    {
        $env = $_ENV;
        $_ENV = "Env files are accessible through the 'config' global function.";

        foreach (array_keys($_SERVER) as $key)
        {
            if (isset($env[$key])) unset($_SERVER[$key]);
        }

        return $env;
    }

    public static function getEnv(string $item): mixed
    {
        return in_array($item, array_keys(static::$env)) ? static::$env[$item] : throw new InvalidArgumentException(sprintf('The "%s" environment variable could not be found.', $item));
    }

    private function initConfig()
    {
        $files = $this->getConfigFiles();
        foreach ($files as $key => $path)
        {
            $this->setConfig($key, require $path);
        }

        return;
    }

    private function setConfig($key, $value = null)
    {
        $keys = is_array($key) ? $key : [$key => $value];

        foreach ($keys as $key => $value)
        {
            self::$config[] = [$key => $value];
        }
    }

    public static function getConfig(string $item): mixed
    {
        foreach (static::$config as $config)
        {
            if (in_array(explode('.', $item)[0], array_keys($config)))
            {
                $group = $config[explode('.', $item)[0]];
                if (isset($group) && is_array($group))
                {
                    $item = explode('.', $item)[1];
                    return in_array($item, array_keys($group)) ? $group[$item] : false;
                }
            }
        }

        return false;
    }

    private function getConfigFiles()
    {
        $files = [];

        $configPath = realpath(config_path());

        foreach (Finder::create()->files()->name('*.php')->in($configPath) as $file)
        {
            $directory = Directory::getNestedDirectory($file, $configPath);

            $files[$directory . basename($file->getRealPath(), '.php')] = $file->getRealPath();
        }

        ksort($files, SORT_NATURAL);

        return $files;
    }
}