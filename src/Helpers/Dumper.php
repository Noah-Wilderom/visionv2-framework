<?php

namespace Visionv2\Helpers;

class Dumper
{


    public function __construct($values)
    {
        $this->values = $values;

        if (!empty($this->values))
        {
            $this->handle();
        }
    }

    private function handle(): void
    {
        //
    }
}