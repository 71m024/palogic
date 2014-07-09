<?php

namespace PaLogic\Bundle\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Boxe
 *
 * @ORM\Table(name="boxe")
 * @ORM\Entity(repositoryClass="PaLogic\Bundle\AppBundle\Entity\Repository\BoxeRepository")
 */
class Boxe extends Component
{

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100)
     */
    private $assembly;

    /**
     * @var string
     *
     * @ORM\Column(type="integer")
     */
    private $kgWeight;
    
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100)
     */
    private $frequency;
    
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100)
     */
    private $dimensions;
    
    public function getDiscr() {
        return "boxe";
    }

    /**
     * Set assembly
     *
     * @param string $assembly
     * @return Boxe
     */
    public function setAssembly($assembly)
    {
        $this->assembly = $assembly;

        return $this;
    }

    /**
     * Get assembly
     *
     * @return string 
     */
    public function getAssembly()
    {
        return $this->assembly;
    }

    /**
     * Set weight
     *
     * @param string $weight
     * @return Boxe
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

    /**
     * Set kgWeight
     *
     * @param integer $kgWeight
     * @return Boxe
     */
    public function setKgWeight($kgWeight)
    {
        $this->kgWeight = $kgWeight;

        return $this;
    }

    /**
     * Get kgWeight
     *
     * @return integer 
     */
    public function getKgWeight()
    {
        return $this->kgWeight;
    }

    /**
     * Set frequency
     *
     * @param string $frequency
     * @return Boxe
     */
    public function setFrequency($frequency)
    {
        $this->frequency = $frequency;

        return $this;
    }

    /**
     * Get frequency
     *
     * @return string 
     */
    public function getFrequency()
    {
        return $this->frequency;
    }

    /**
     * Set dimensions
     *
     * @param string $dimensions
     * @return Boxe
     */
    public function setDimensions($dimensions)
    {
        $this->dimensions = $dimensions;

        return $this;
    }

    /**
     * Get dimensions
     *
     * @return string 
     */
    public function getDimensions()
    {
        return $this->dimensions;
    }
}
