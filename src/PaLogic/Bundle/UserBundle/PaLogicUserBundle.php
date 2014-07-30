<?php

namespace PaLogic\Bundle\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class PaLogicUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle'; // Name of parent bundle
    }
}
