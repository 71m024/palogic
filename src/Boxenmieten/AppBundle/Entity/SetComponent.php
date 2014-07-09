<?php

namespace Boxenmieten\AppBundle\Entity;

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
     * @param \Boxenmieten\AppBundle\Entity\Set $set
     * @return SetComponent
     */
    public function setSet(\Boxenmieten\AppBundle\Entity\Set $set)
    {
        $this->set = $set;

        return $this;
    }

    /**
     * Get set
     *
     * @return \Boxenmieten\AppBundle\Entity\Set 
     */
    public function getSet()
    {
        return $this->set;
    }

    /**
     * Set component
     *
     * @param \Boxenmieten\AppBundle\Entity\Component $component
     * @return SetComponent
     */
    public function setComponent(\Boxenmieten\AppBundle\Entity\Component $component)
    {
        $this->component = $component;

        return $this;
    }

    /**
     * Get component
     *
     * @return \Boxenmieten\AppBundle\Entity\Component 
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
