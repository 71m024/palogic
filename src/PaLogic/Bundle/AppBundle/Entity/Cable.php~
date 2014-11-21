<?php

namespace PaLogic\Bundle\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Stand
 *
 * @ORM\Table(name="cable")
 * @ORM\Entity(repositoryClass="PaLogic\Bundle\AppBundle\Entity\Repository\CableRepository")
 */
class Cable extends Article
{

    /**
     * @var string
     *
     * @ORM\Column(name="maxHeight", type="smallint")
     */
    private $cmLength;

    /**
     * @var string
     *
     * @ORM\Column(name="minHeight", type="string", length=50)
     */
    private $type;
    
    
    public function getDiscr() {
        return "cable";
    }

    /**
     * Set cmLength
     *
     * @param integer $cmLength
     * @return Cable
     */
    public function setCmLength($cmLength)
    {
        $this->cmLength = $cmLength;

        return $this;
    }

    /**
     * Get cmLength
     *
     * @return integer 
     */
    public function getCmLength()
    {
        return $this->cmLength;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Cable
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }
    /**
     * @var string
     */
}
