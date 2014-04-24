<?php

namespace Boxenmieten\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Stand
 *
 * @ORM\Table(name="stand")
 * @ORM\Entity(repositoryClass="Boxenmieten\AppBundle\Entity\Repository\StandRepository")
 */
class Stand extends Component
{

    /**
     * @var string
     *
     * @ORM\Column(name="maxHeight", type="string", length=10)
     */
    private $maxHeight;

    /**
     * @var string
     *
     * @ORM\Column(name="minHeight", type="string", length=10)
     */
    private $minHeight;

    /**
     * @var string
     *
     * @ORM\Column(name="maxLoad", type="string", length=10)
     */
    private $maxLoad;
    
    public function getDiscr() {
        return "stand";
    }

    /**
     * Set maxHeight
     *
     * @param string $maxHeight
     * @return Stand
     */
    public function setMaxHeight($maxHeight)
    {
        $this->maxHeight = $maxHeight;

        return $this;
    }

    /**
     * Get maxHeight
     *
     * @return string 
     */
    public function getMaxHeight()
    {
        return $this->maxHeight;
    }

    /**
     * Set minHeight
     *
     * @param string $minHeight
     * @return Stand
     */
    public function setMinHeight($minHeight)
    {
        $this->minHeight = $minHeight;

        return $this;
    }

    /**
     * Get minHeight
     *
     * @return string 
     */
    public function getMinHeight()
    {
        return $this->minHeight;
    }

    /**
     * Set maxLoad
     *
     * @param string $maxLoad
     * @return Stand
     */
    public function setMaxLoad($maxLoad)
    {
        $this->maxLoad = $maxLoad;

        return $this;
    }

    /**
     * Get maxLoad
     *
     * @return string 
     */
    public function getMaxLoad()
    {
        return $this->maxLoad;
    }
}
