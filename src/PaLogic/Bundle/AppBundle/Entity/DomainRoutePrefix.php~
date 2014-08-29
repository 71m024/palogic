<?php

namespace PaLogic\Bundle\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DomainRoutePrefix
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PaLogic\Bundle\AppBundle\Entity\Repository\DomainRoutePrefixRepository")
 */
class DomainRoutePrefix
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="domain", type="string", length=100)
     */
    private $domain;

    /**
     * @var string
     *
     * @ORM\Column(name="prefix", type="string", length=50)
     */
    private $prefix;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set domain
     *
     * @param string $domain
     * @return DomainRoutePrefix
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * Get domain
     *
     * @return string 
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Set prefix
     *
     * @param string $prefix
     * @return DomainRoutePrefix
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;

        return $this;
    }

    /**
     * Get prefix
     *
     * @return string 
     */
    public function getPrefix()
    {
        return $this->prefix;
    }
}
