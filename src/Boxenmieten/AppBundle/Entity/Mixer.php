<?php

namespace Boxenmieten\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Stand
 *
 * @ORM\Table(name="mixer")
 * @ORM\Entity(repositoryClass="Boxenmieten\AppBundle\Entity\Repository\MixerRepository")
 */
class Mixer extends Component
{

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100)
     */
    private $inputs;
    
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100)
     */
    private $outputs;
    
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100)
     */
    private $preamps;
    
    public function getDiscr() {
        return "mixer";
    }

    /**
     * Set inputs
     *
     * @param string $inputs
     * @return Mixer
     */
    public function setInputs($inputs)
    {
        $this->inputs = $inputs;

        return $this;
    }

    /**
     * Get inputs
     *
     * @return string 
     */
    public function getInputs()
    {
        return $this->inputs;
    }

    /**
     * Set outputs
     *
     * @param string $outputs
     * @return Mixer
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

    /**
     * Set preamps
     *
     * @param string $preamps
     * @return Mixer
     */
    public function setPreamps($preamps)
    {
        $this->preamps = $preamps;

        return $this;
    }

    /**
     * Get preamps
     *
     * @return string 
     */
    public function getPreamps()
    {
        return $this->preamps;
    }
}
