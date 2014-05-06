<?php

namespace Boxenmieten\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Stand
 *
 * @ORM\Table(name="mic")
 * @ORM\Entity(repositoryClass="Boxenmieten\AppBundle\Entity\Repository\MicRepository")
 */
class Mic extends Component
{

    /**
     * @var string
     *
     * @ORM\Column(name="sensitivity", type="string", length=30)
     */
    private $sensitivity;

    /**
     * @var string
     *
     * @ORM\Column(name="directivity", type="string", length=30)
     */
    private $directivity;

    /**
     * @var string
     *
     * @ORM\Column(name="transmissionrange", type="string", length=30)
     */
    private $transmissionRange;
    
    /**
     * @var string
     *
     * @ORM\Column(name="weight", type="string", length=30)
     */
    private $weight;
    
    public function getDiscr() {
        return "mic";
    }

    /**
     * Set sensitivity
     *
     * @param string $sensitivity
     * @return Mic
     */
    public function setSensitivity($sensitivity)
    {
        $this->sensitivity = $sensitivity;

        return $this;
    }

    /**
     * Get sensitivity
     *
     * @return string 
     */
    public function getSensitivity()
    {
        return $this->sensitivity;
    }

    /**
     * Set directivity
     *
     * @param string $directivity
     * @return Mic
     */
    public function setDirectivity($directivity)
    {
        $this->directivity = $directivity;

        return $this;
    }

    /**
     * Get directivity
     *
     * @return string 
     */
    public function getDirectivity()
    {
        return $this->directivity;
    }

    /**
     * Set transmissionRange
     *
     * @param string $transmissionRange
     * @return Mic
     */
    public function setTransmissionRange($transmissionRange)
    {
        $this->transmissionRange = $transmissionRange;

        return $this;
    }

    /**
     * Get transmissionRange
     *
     * @return string 
     */
    public function getTransmissionRange()
    {
        return $this->transmissionRange;
    }

    /**
     * Set weight
     *
     * @param string $weight
     * @return Mic
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return string 
     */
    public function getWeight()
    {
        return $this->weight;
    }
}
