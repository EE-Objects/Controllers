<?php
namespace EeObjects\Controllers;

use EeObjects\Controller;
use EeObjects\Str;
use EeObjects\Controllers\Extension\AbstractRoute;
use EeObjects\Exceptions\ControllerException;

class Extension extends Controller
{
    protected $route_namespace = 'EeObjects\Addon\Controllers';

    /**
     * @param $method
     * @param false $action
     * @return string
     * @throws ControllerException
     */
    protected function buildObject($method, $action = false): string
    {
        if ($this->getRouteNamespace() == '') {
            throw new ControllerException("Your Controller Namespace isn't seutp yet!");
        }

        $object = '\\'.$this->getRouteNamespace().'\\Extensions\\';
        $object .= 'Routes\\'. Str::studly($method);

        return $object;
    }

    public function __call($method, $params)
    {
        $object = $this->buildObject($method);
        if (class_exists($object)) {

            $controller = new $object();
            if ($controller instanceof AbstractRoute) {
                return $controller->process();
            }
        }

        throw new ControllerException("Invalid Extension request! Are you sure $object is setup properly?");
    }
}