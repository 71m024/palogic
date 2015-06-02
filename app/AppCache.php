<?php

require_once __DIR__.'/AppKernel.php';

use Megogo\Bundle\MultipleInheritanceBundle\HttpKernel\HttpCache\HttpCache as BaseCache;

class AppCache extends BaseCache
{
    protected function getOptions()
    {
        return array(
            'default_ttl'            => 86400,
            'allow_reload'           => false,
            'allow_revalidate'       => false
        );
    }
}
