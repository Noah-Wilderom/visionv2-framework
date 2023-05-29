<?php

namespace Visionv2\Helpers;

use Symfony\Component\Finder\SplFileInfo;

class Directory
{

    public static function getNestedDirectory(SplFileInfo $file, $path)
    {
        $directory = $file->getPath();

        if ($nested = trim(str_replace($path, '', $directory), DIRECTORY_SEPARATOR))
        {
            $nested = str_replace(DIRECTORY_SEPARATOR, '.', $nested) . '.';
        }

        return $nested;
    }
}