<?php
namespace EeObjects\Controllers;

use EeObjects\Exceptions\Controllers\Cp\RouteException;

abstract class AbstractRoute
{
    /**
     * The shortname for the add-on this is attached to
     * @var string
     */
    protected $module_name = '';

    /**
     * @return string
     * @throws RouteException
     */
    protected function getModuleName(): string
    {
        if ($this->module_name == '') {
            throw new RouteException("Your `module_name` property hasn't been seetup!");
        }

        return $this->module_name;
    }
}