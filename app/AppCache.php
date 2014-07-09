<?php

require_once __DIR__.'/AppKernel.php';

use Megogo\Bundle\MultipleInheritanceBundle\HttpKernel\HttpCache\HttpCache as BaseCache;

class AppCache extends BaseCache
{
}
