<?php

namespace DjCrowd\Bundle\BlogBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Megogo\Bundle\MultipleInheritanceBundle\Routing\RoutingAdditionsInterface;

class DjCrowdBlogBundle extends Bundle implements RoutingAdditionsInterface
{
    /**
     * In this method you specify routes resources, that you need to duplicate
     */
    public function getResourcesToOverride()
    {
        return array(
            '@PaLogicBlogBundle/Resources/config/routing.yml',
        );
    }

    public function getParent()
    {
        return 'PaLogicBlogBundle'; // Name of parent bundle
    }

    public function getRoutingPrefix()
    {
        return 'djcrowd';
    }

    public function getDefaults()
    {
        return array(); // This array will be merged with defaults of each route of parent bundle
    }

    public function getRequirements()
    {
        return array(); // This array will be merged with requirements of each route of parent bundle
    }

    public function getHost()
    {
        return 'djcrowd.dev'; // Specifying domain restriction for routes. Leave it as empty string for disable host requirement
    }
}
