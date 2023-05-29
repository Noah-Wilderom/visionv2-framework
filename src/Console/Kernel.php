<?php

namespace Visionv2\Console;

class Kernel
{

    protected static $commands = [];

    public function __construct()
    {
        static::init();
    }

    public static function init()
    {
        //
    }

    private function loadCommands()
    {
        //
        // $className = 'MyClass';
        // $object = new $className;
    }

    public static function add(array $options, callable $callback = null)
    {
        //
    }

    public static function help()
    {
        print_r(self::printColor("Vision V2 Framework Kernel PHP\n\n\n", 'green'));
    }

    public static function execute(array $command, $data = null)
    {
        //
    }

    public static function stubCommand(string $stub, array $keywords)
    {
        //
    }

    public static function printColor($content, $color = null)
    {
        if (!empty($color))
        {
            if (!is_numeric($color))
            {
                $c = strtolower($color);
            }
            else
            {
                if (!empty($color))
                {
                    $c = $color;
                }
                else
                {
                    $c = rand(1, 14);
                }
            }
        }
        else
        {
            $c = rand(1, 14);
        }

        $cheader = '';
        $cfooter = "\033[0m";

        switch ($c)
        {
            case 1:
            case 'red':
                $cheader .= "\033[31m";
                break;

            case 2:
            case 'green':
                $cheader .= "\033[32m";
                break;

            case 3:
            case 'yellow':
                $cheader .= "\033[33m";
                break;

            case 4:
            case 'blue':
                $cheader .= "\033[34m";
                break;

            case 5:
            case 'magenta':
                $cheader .= "\033[35m";
                break;

            case 6:
            case 'cyan':
                $cheader .= "\033[36m";
                break;

            case 7:
            case 'light grey':
                $cheader .= "\033[37m";
                break;

            case 8:
            case 'dark grey':
                $cheader .= "\033[90m";
                break;

            case 9:
            case 'light red':
                $cheader .= "\033[91m";
                break;

            case 10:
            case 'light green':
                $cheader .= "\033[92m";
                break;

            case 11:
            case 'light yellow':
                $cheader .= "\033[93m";
                break;

            case 12:
            case 'light blue':
                $cheader .= "\033[94m";
                break;

            case 13:
            case 'light magenta':
                $cheader .= "\033[95m";
                break;

            case 14:
            case 'light cyan':
                $cheader .= "\033[92m";
                break;
        }

        $content = $cheader . $content . $cfooter;
        return $content;
    }
}