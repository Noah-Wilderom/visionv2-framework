<?php

namespace Visionv2\Exceptions;

use Exception;
use Symfony\Component\Finder\Finder;

class HttpException extends Exception
{
    public function __construct($message, $code = 500)
    {
        $error = $message;
        foreach(Finder::create()->files()->name('*.php')->in(dirname(__FILE__) . '/errorpages/http') as $file)
        {
            if($file->getFilenameWithoutExtension() == $code)
            {
                require_once 'errorpages/http/' . $code . '.php';
                exit();
            }
        }

        throw new Exception(sprintf('Cannot find error page for http error code: [%s]', $code));
    }
}