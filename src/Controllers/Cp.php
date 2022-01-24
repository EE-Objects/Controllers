<?php

namespace EeObjects\Controllers;

use EeObjects\Controller;
use EeObjects\Str;
use EeObjects\Exceptions\ControllerException;

class Cp extends Controller
{
    /**
     * @var string
     */
    protected $action = '';

    /**
     * @var string
     */
    protected $id = '';

    /**
     * @param $domain
     * @param $params
     * @return mixed
     * @throws ControllerException
     */
    protected function process($domain)
    {
        $object = $this->buildObject($domain);
        if (class_exists($object)) {
            $controller = new $object();
            if ($controller instanceof Cp\AbstractRoute) {
                return $controller->process($this->id);
            }
        }
    }

    /**
     * @param $domain
     * @param $params
     * @return mixed
     * @throws ControllerException
     */
    public function route($domain, $params)
    {
        $this->parseParams($params);
        $route = $this->process($domain);
        if ($route instanceof Cp\AbstractRoute) {
            return $route->toArray();
        }

        show_404();
    }

    /**
     * @param $params
     * @return $this
     */
    protected function parseParams($params): Cp
    {
        if (!empty($params['0'])) {
            if(!is_numeric($params['0'])) {
                $this->action = $params['0'];
            } else {
                $this->id = $params['0'];
            }
        }

        if (!empty($params['1'])) {
            $this->id = (int)$params['1'];
        }

        return $this;
    }

    /**
     * @param $domain
     * @return string
     * @throws ControllerException
     */
    protected function buildObject($domain): string
    {
        if ($this->getRouteNamespace() == '') {
            throw new ControllerException("Your Controller Namespace isn't seutp yet!");
        }

        $object = '\\'.$this->getRouteNamespace().'\\Cp\\Routes\\' . Str::studly($domain);
        if ($this->action) {
            $object .= '\\' . Str::studly($this->action);
        }

        return $object;
    }
}
