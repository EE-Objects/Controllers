<?php
namespace EeObjects\Controllers;

use EeObjects\Controller;
use EeObjects\Str;
use EeObjects\Controllers\Extension\AbstractRoute;
use EeObjects\Exceptions\ControllerException;

class Extension extends Controller
{
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

        $object = '\\'.$this->getRouteNamespace().'\\Extension\\';
        $object .= 'Routes\\'. Str::studly($method);

        return $object;
    }

    /**
     * @param $method
     * @param $params
     * @return mixed
     * @throws ControllerException
     */
    public function __call($method, $params)
    {
        $object = $this->buildObject($method);
        if (class_exists($object)) {

            $controller = new $object();
            if ($controller instanceof AbstractRoute) {
                if(method_exists($controller, 'process')) {
                    return call_user_func_array([$controller, 'process'], $params);
                }
            }
        }

        throw new ControllerException("Invalid Extension request! Are you sure $object is setup properly?");
    }
}