<?php

namespace PaLogic\Bundle\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="set_component")
 * @ORM\Entity
 */
class SetComponent
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
     * @var integer
     * 
     * @ORM\Column(type="integer")
     */
    private $num;
    
    /**
     * @ORM\ManyToOne(targetEntity="Set", inversedBy="components")
     */
    private $set;
    
    /**
     * @ORM\ManyToOne(targetEntity="Component", inversedBy="sets")
     */
    private $component;

    /**
     * Set num
     *
     * @param integer $num
     * @return SetComponent
     */
    public function setNum($num)
    {
        $this->num = $num;

        return $this;
    }

    /**
     * Get num
     *
     * @return integer 
     */
    public function getNum()
    {
        return $this->num;
    }

    /**
     * Set set
     *
     * @param \PaLogic\Bundle\AppBundle\Entity\Set $set
     * @return SetComponent
     */
    public function setSet(\PaLogic\Bundle\AppBundle\Entity\Set $set)
    {
        $this->set = $set;

        return $this;
    }

    /**
     * Get set
     *
     * @return \PaLogic\Bundle\AppBundle\Entity\Set 
     */
    public function getSet()
    {
        return $this->set;
    }

    /**
     * Set component
     *
     * @param \PaLogic\Bundle\AppBundle\Entity\Component $component
     * @return SetComponent
     */
    public function setComponent(\PaLogic\Bundle\AppBundle\Entity\Component $component)
    {
        $this->component = $component;

        return $this;
    }

    /**
     * Get component
     *
     * @return \PaLogic\Bundle\AppBundle\Entity\Component 
     */
    public function getComponent()
    {
        return $this->component;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}
