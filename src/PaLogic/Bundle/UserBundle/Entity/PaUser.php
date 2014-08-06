<?php
// src/Acme/UserBundle/Entity/User.php

namespace PaLogic\Bundle\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="pauser")
 */
class PaUser extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     *
     * @ORM\OneToMany(targetEntity="PaLogic\Bundle\DjBundle\Entity\Dj", mappedBy="owner")
     */
    private $djs;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
}