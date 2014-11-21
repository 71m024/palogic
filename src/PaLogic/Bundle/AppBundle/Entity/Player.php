<?php

namespace PaLogic\Bundle\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Player
 *
 * @ORM\Table(name="player")
 * @ORM\Entity(repositoryClass="PaLogic\Bundle\AppBundle\Entity\Repository\PlayerRepository")
 */
class Player extends Article
{

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100)
     */
    private $supportedFormats;
    
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100)
     */
    private $outputs;
    
    public function getDiscr() {
        return "player";
    }

    /**
     * Set supportedFormats
     *
     * @param string $supportedFormats
     * @return Player
     */
    public function setSupportedFormats($supportedFormats)
    {
        $this->supportedFormats = $supportedFormats;

        return $this;
    }

    /**
     * Get supportedFormats
     *
     * @return string 
     */
    public function getSupportedFormats()
    {
        return $this->supportedFormats;
    }

    /**
     * Set outputs
     *
     * @param string $outputs
     * @return Player
     */
    public function setOutputs($outputs)
    {
        $this->outputs = $outputs;

        return $this;
    }

    /**
     * Get outputs
     *
     * @return string 
     */
    public function getOutputs()
    {
        return $this->outputs;
    }
}
