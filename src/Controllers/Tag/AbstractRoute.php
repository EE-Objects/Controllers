<?php
namespace EeObjects\Controllers\Tag;

use EeObjects\Controllers\AbstractRoute AS CoreAbstractRoute;

abstract class AbstractRoute extends CoreAbstractRoute
{
    abstract public function process();
}