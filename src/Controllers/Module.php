<?php
namespace EeObjects\Controllers;

use EeObjects\Controller;
use EeObjects\Str;
use EeObjects\Exceptions\ControllerException;
use EeObjects\Controllers\Action\AbstractRoute AS ActionRoute;
use EeObjects\Controllers\Tag\AbstractRoute AS TagRoute;

class Module extends Controller
{
    /**
     * Checks if we have an Action based request
     * @param $method
     * @return bool
     */
    protected function isActRequest(string $method): bool
    {
        return substr($method, -6) == 'action' && ee()->input->get_post('ACT');
    }

    /**
     * @param $method
     * @param $params
     */
    protected function routeAction(string $method)
    {
        $object = $this->buildObject($method, true);
        return $this->route($object);
    }

    /**
     * @param string $method
     * @return mixed
     * @throws ControllerException
     */
    protected function routeTag(string $method)
    {
        $object = $this->buildObject($method);
        return $this->route($object);
    }

    /**
     * @param $object
     * @return mixed
     */
    protected function route($object)
    {
        if (class_exists($object)) {

            $controller = new $object();
            if ($controller instanceof ActionRoute) {
                return $controller->process();
            }

            if ($controller instanceof TagRoute) {
                return $controller->process();
            }
        }

        throw new ControllerException("Invalid Module request! Are you sure $object is setup properly?");
    }

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

        $object = '\\'.$this->getRouteNamespace().'\\';
        if($action) {
            $object .= 'Action\\';
        } else {
            $object .= 'Tag\\';
        }

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
        if ($this->isActRequest($method)) {
            return $this->routeAction($method, $params);
        }

        return $this->routeTag($method, $params);
    }
}