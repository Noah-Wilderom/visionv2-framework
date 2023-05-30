<?php

namespace Visionv2\Core;

class Container
{
    /**
     * @var array
     */
    private array $containers;

    public function __construct()
    {
        $this->containers = [];
    }

    /**
     * @return array
     */
    public function getContainers()
    {
        return $this->containers;
    }

    /**
     * @param string $class
     * @return void
     */
    public function add(string $class)
    {
        $this->containers[$class] = new $class;
    }

    /**
     * @param string $class
     * @return bool
     */
    public function exists(string $class)
    {
        return isset($this->containers[$class]);
    }

    /**
     * @param string $class
     * @return void
     */
    public function remove(string $class)
    {
        unset($this->containers[$class]);
    }

    /**
     * @param string $class
     * @return mixed
     */
    public function get(string $class)
    {
        return $this->containers[$class];
    }


}