<?php

namespace EeObjects\Controllers\Extension;

use EeObjects\Controllers\AbstractRoute AS CoreAbstractRoute;

abstract class AbstractRoute extends CoreAbstractRoute
{
    /**
     * @return mixed
     */
    abstract public function process();
}