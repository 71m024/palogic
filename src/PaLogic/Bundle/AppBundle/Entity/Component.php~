<?php

namespace PaLogic\Bundle\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Component
 *
 * @ORM\Table(name="component")
 * @ORM\Entity(repositoryClass="PaLogic\Bundle\AppBundle\Entity\Repository\ComponentRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"boxe" = "Boxe", "stand" = "Stand", "cable" = "Cable", "mixer" = "Mixer", "mic" = "Mic"})
 */
class Component
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var string
     * 
     * @Gedmo\Mapping\Annotation\Slug(fields={"make", "model"})
     * @ORM\Column(length=64, unique=true)
     */
    private $slug;
    
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
     * @ORM\Column(name="make", type="string", length=100)
     */
    private $make;

    /**
     * @var string
     *
     * @ORM\Column(name="manufacturer", type="string", length=100)
     */
    private $manufacturer;

    /**
     * @var integer
     *
     * @ORM\Column(name="price", type="smallint")
     */
    private $price;

    /**
     * @var integer
     *
     * @ORM\Column(name="weekprice", type="smallint")
     */
    private $weekPrice;

    /**
     * @var string
     *
     * @ORM\Column(name="model", type="string", length=100)
     */
    private $model;
    
    /**
     * @ORM\ManyToOne(targetEntity="PaLogic\Bundle\ImageBundle\Entity\Image")
     */
    private $previewImage;
    
    /**
     * @ORM\ManyToMany(targetEntity="PaLogic\Bundle\ImageBundle\Entity\Image", cascade={"persist", "remove"})
     */
    private $images;
    
    /**
     * @var string
     *
     * @ORM\Column(name="website", type="string", length=200)
     */
    private $website;
    
    /**
     * @ORM\OneToMany(targetEntity="SetComponent", mappedBy="component", cascade={"persist", "remove"})
     */
    private $sets;
    
    
    public function __toString() {
        return $this->make.",".$this->model;
    }
    
    /* Workaround to get Discriminator */
    public function getDiscr() {
        return null;
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
     * Set make
     *
     * @param string $make
     * @return Component
     */
    public function setMake($make)
    {
        $this->make = $make;
        
        return $this;
    }

    /**
     * Get make
     *
     * @return string 
     */
    public function getMake()
    {
        return $this->make;
    }

    /**
     * Set manufacturer
     *
     * @param string $manufacturer
     * @return Component
     */
    public function setManufacturer($manufacturer)
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    /**
     * Get manufacturer
     *
     * @return string 
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    /**
     * Set price
     *
     * @param integer $price
     * @return Component
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return integer 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set model
     *
     * @param string $model
     * @return Component
     */
    public function setModel($model)
    {
        $this->model = $model;
        
        return $this;
    }

    /**
     * Get model
     *
     * @return string 
     */
    public function getModel()
    {
        return $this->model;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set weekPrice
     *
     * @param integer $weekPrice
     * @return Component
     */
    public function setWeekPrice($weekPrice)
    {
        $this->weekPrice = $weekPrice;

        return $this;
    }

    /**
     * Get weekPrice
     *
     * @return integer 
     */
    public function getWeekPrice()
    {
        return $this->weekPrice;
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
     * Set website
     *
     * @param string $website
     * @return Component
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string 
     */
    public function getWebsite()
    {
        return $this->website;
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
     * Set previewImage
     *
     * @param \PaLogic\Bundle\ImageBundle\Entity\Image $previewImage
     * @return Component
     */
    public function setPreviewImage(\PaLogic\Bundle\ImageBundle\Entity\Image $previewImage = null)
    {
        $this->previewImage = $previewImage;

        return $this;
    }

    /**
     * Get previewImage
     *
     * @return \PaLogic\Bundle\ImageBundle\Entity\Image 
     */
    public function getPreviewImage()
    {
        return $this->previewImage;
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
     * Add images
     *
     * @param \PaLogic\Bundle\ImageBundle\Entity\Image $images
     * @return Component
     */
    public function addImage(\PaLogic\Bundle\ImageBundle\Entity\Image $images)
    {
        $this->images[] = $images;

        return $this;
    }

    /**
     * Remove images
     *
     * @param \PaLogic\Bundle\ImageBundle\Entity\Image $images
     */
    public function removeImage(\PaLogic\Bundle\ImageBundle\Entity\Image $images)
    {
        $this->images->removeElement($images);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getImages()
    {
        return $this->images;
    }
}
