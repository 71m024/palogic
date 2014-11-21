<?php

namespace PaLogic\Bundle\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="PaLogic\Bundle\AppBundle\Entity\Repository\ArticleRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"boxe" = "Boxe", "stand" = "Stand", "cable" = "Cable", "mixer" = "Mixer", "mic" = "Mic"})
 */
class Article
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
    private $image;
    
    /**
     * @ORM\ManyToMany(targetEntity="PaLogic\Bundle\ImageBundle\Entity\Image", cascade={"persist", "remove"})
     */
    private $images;
    
    /**
     * @ORM\ManyToMany(targetEntity="PaLogic\Bundle\AppBundle\Entity\Component", cascade={"persist", "remove"})
     */
    private $components;
    
    /**
     * @var string
     *
     * @ORM\Column(name="website", type="string", length=200)
     */
    private $website;
    
    
    public function __toString() {
        return $this->make.", ".$this->model;
    }
    
    /* Workaround to get Discriminator */
    public function getDiscr() {
        return null;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set slug
     *
     * @param string $slug
     * @return Article
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
     * @return Article
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
     * @return Article
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
     * @return Article
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
     * Set make
     *
     * @param string $make
     * @return Article
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
     * @return Article
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
     * @return Article
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
     * Set weekPrice
     *
     * @param integer $weekPrice
     * @return Article
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
     * Set model
     *
     * @param string $model
     * @return Article
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
     * Set website
     *
     * @param string $website
     * @return Article
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
     * Set image
     *
     * @param \PaLogic\Bundle\ImageBundle\Entity\Image $image
     * @return Article
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

    /**
     * Add images
     *
     * @param \PaLogic\Bundle\ImageBundle\Entity\Image $images
     * @return Article
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

    /**
     * Add components
     *
     * @param \PaLogic\Bundle\AppBundle\Entity\Component $components
     * @return Article
     */
    public function addComponent(\PaLogic\Bundle\AppBundle\Entity\Component $components)
    {
        $this->components[] = $components;

        return $this;
    }

    /**
     * Remove components
     *
     * @param \PaLogic\Bundle\AppBundle\Entity\Component $components
     */
    public function removeComponent(\PaLogic\Bundle\AppBundle\Entity\Component $components)
    {
        $this->components->removeElement($components);
    }

    /**
     * Get components
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComponents()
    {
        return $this->components;
    }
}
