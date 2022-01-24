<?php

namespace EeObjects;

class Controller
{
    /**
     * Used to locate child objects
     * @var string
     */
    protected $route_namespace = '';

    /**
     * @param string $namespace
     * @return $this
     */
    public function setRouteNamespace(string $namespace): Controller
    {
        $this->route_namespace = $namespace;
        return $this;
    }

    /**
     * @return string
     */
    public function getRouteNamespace()
    {
        return $this->route_namespace;
    }
}
