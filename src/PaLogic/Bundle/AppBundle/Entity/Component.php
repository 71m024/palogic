<?php

namespace PaLogic\Bundle\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as GEDMO;

/**
 * Component
 *
 * @ORM\Table(name="component")
 * @ORM\Entity(repositoryClass="PaLogic\Bundle\AppBundle\Entity\Repository\ComponentRepository")
 */
class Component {
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(type="text")
     */
    private $name;
    
    /**
     * @ORM\Column(type="text")
     */
    private $description;
    
    /**
     * @ORM\Column(type="string")
     */
    private $descriptionFormatter;
    
    /**
     * @ORM\Column(type="text")
     */
    private $rawDescription;
    
    /**
     * @var string
     * 
     * @GEDMO\Slug(fields={"name"})
     * @ORM\Column(length=64, unique=true)
     */
    private $slug;
    
    /**
     * @ORM\OneToMany(targetEntity="SetComponent", mappedBy="component", cascade={"persist", "remove"})
     */
    private $sets;
    
    /**
     * @ORM\ManyToMany(targetEntity="PaLogic\Bundle\AppBundle\Entity\Article", cascade={"persist", "remove"})
     */
    private $possibleArticles;
    
    /**
     * @ORM\ManyToOne(targetEntity="PaLogic\Bundle\ImageBundle\Entity\Image")
     */
    private $image;
    
    public function __toString() {
        return $this->name;
    }
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sets = new \Doctrine\Common\Collections\ArrayCollection();
        $this->possibleArticles = new \Doctrine\Common\Collections\ArrayCollection();
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

    /**
     * Set name
     *
     * @param string $name
     * @return Component
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Component
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set descriptionFormatter
     *
     * @param string $descriptionFormatter
     * @return Component
     */
    public function setDescriptionFormatter($descriptionFormatter)
    {
        $this->descriptionFormatter = $descriptionFormatter;

        return $this;
    }

    /**
     * Get descriptionFormatter
     *
     * @return string 
     */
    public function getDescriptionFormatter()
    {
        return $this->descriptionFormatter;
    }

    /**
     * Set rawDescription
     *
     * @param string $rawDescription
     * @return Component
     */
    public function setRawDescription($rawDescription)
    {
        $this->rawDescription = $rawDescription;

        return $this;
    }

    /**
     * Get rawDescription
     *
     * @return string 
     */
    public function getRawDescription()
    {
        return $this->rawDescription;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Component
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Add sets
     *
     * @param \PaLogic\Bundle\AppBundle\Entity\SetComponent $sets
     * @return Component
     */
    public function addSet(\PaLogic\Bundle\AppBundle\Entity\SetComponent $sets)
    {
        $this->sets[] = $sets;

        return $this;
    }

    /**
     * Remove sets
     *
     * @param \PaLogic\Bundle\AppBundle\Entity\SetComponent $sets
     */
    public function removeSet(\PaLogic\Bundle\AppBundle\Entity\SetComponent $sets)
    {
        $this->sets->removeElement($sets);
    }

    /**
     * Get sets
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSets()
    {
        return $this->sets;
    }

    /**
     * Add possibleArticles
     *
     * @param \PaLogic\Bundle\AppBundle\Entity\Article $possibleArticles
     * @return Component
     */
    public function addPossibleArticle(\PaLogic\Bundle\AppBundle\Entity\Article $possibleArticles)
    {
        $this->possibleArticles[] = $possibleArticles;

        return $this;
    }

    /**
     * Remove possibleArticles
     *
     * @param \PaLogic\Bundle\AppBundle\Entity\Article $possibleArticles
     */
    public function removePossibleArticle(\PaLogic\Bundle\AppBundle\Entity\Article $possibleArticles)
    {
        $this->possibleArticles->removeElement($possibleArticles);
    }

    /**
     * Get possibleArticles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPossibleArticles()
    {
        return $this->possibleArticles;
    }

    /**
     * Set image
     *
     * @param \PaLogic\Bundle\ImageBundle\Entity\Image $image
     * @return Component
     */
    public function setImage(\PaLogic\Bundle\ImageBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \PaLogic\Bundle\ImageBundle\Entity\Image 
     */
    public function getImage()
    {
        return $this->image;
    }
}
