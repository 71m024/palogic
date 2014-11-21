<?php

namespace PaLogic\Bundle\DjBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Dj
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PaLogic\Bundle\DjBundle\Entity\Repository\DjRepository")
 */
class Dj
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
     * @var \DateTime
     * 
     * @ORM\Column(name="created", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $created;

    /**
     * @var \DateTime
     * 
     * @ORM\Column(name="updated", type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $updated;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=30, nullable=false)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=false)
     */
    private $description;
    
    /**
     * @ORM\ManyToOne(targetEntity="PaLogic\Bundle\ImageBundle\Entity\Image")
     * @ORM\JoinColumn(nullable=false)
     */
    private $headshot;
    
    /**
     * @ORM\ManyToMany(targetEntity="PaLogic\Bundle\ImageBundle\Entity\Image")
     */
    private $images;
    
    /**
     * @ORM\ManyToOne(targetEntity="PaLogic\Bundle\UserBundle\Entity\PaUser", inversedBy="djs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $owner;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="approved", type="boolean", nullable=false)
     */
    private $approved = false;
    
    /**
     * @ORM\ManyToMany(targetEntity="PaLogic\Bundle\DjBundle\Entity\Genre", inversedBy="djs")
     */
    private $genres;
    
    /**
     * @ORM\Column(type="string")
     * @Gedmo\Slug(fields={"name"})
     */
    protected $slug;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Url()
     */
    protected $facebook;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Url()
     */
    protected $twitter;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Url()
     */
    protected $googleplus;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Url()
     */
    protected $youtube;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Url()
     */
    protected $soundcloud;


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
     * @return Dj
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
     * Set phone
     *
     * @param string $phone
     * @return Dj
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Dj
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Dj
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
     * Constructor
     */
    public function __construct()
    {
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set user
     *
     * @param \PaLogic\Bundle\UserBundle\Entity\PaUser $owner
     * @return Dj
     */
    public function setOwner(\PaLogic\Bundle\UserBundle\Entity\PaUser $owner = null)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get user
     *
     * @return \PaLogic\Bundle\UserBundle\Entity\PaUser 
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set approved
     *
     * @param boolean $approved
     * @return Dj
     */
    public function setApproved($approved)
    {
        $this->approved = $approved;

        return $this;
    }

    /**
     * Get approved
     *
     * @return boolean 
     */
    public function getApproved()
    {
        return $this->approved;
    }

    /**
     * Add genres
     *
     * @param \PaLogic\Bundle\DjBundle\Entity\Genre $genres
     * @return Dj
     */
    public function addGenre(\PaLogic\Bundle\DjBundle\Entity\Genre $genres)
    {
        $this->genres[] = $genres;

        return $this;
    }

    /**
     * Remove genres
     *
     * @param \PaLogic\Bundle\DjBundle\Entity\Genre $genres
     */
    public function removeGenre(\PaLogic\Bundle\DjBundle\Entity\Genre $genres)
    {
        $this->genres->removeElement($genres);
    }

    /**
     * Get genres
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGenres()
    {
        return $this->genres;
    }

    /**
     * Set headshot
     *
     * @param \PaLogic\Bundle\ImageBundle\Entity\Image $headshot
     * @return Dj
     */
    public function setHeadshot(\PaLogic\Bundle\ImageBundle\Entity\Image $headshot = null)
    {
        $this->headshot = $headshot;

        return $this;
    }

    /**
     * Get headshot
     *
     * @return \PaLogic\Bundle\ImageBundle\Entity\Image 
     */
    public function getHeadshot()
    {
        return $this->headshot;
    }

    /**
     * Add images
     *
     * @param \PaLogic\Bundle\ImageBundle\Entity\Image $images
     * @return Dj
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
     * Set slug
     *
     * @param string $slug
     * @return Dj
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
     * Set created
     *
     * @param \DateTime $created
     * @return Dj
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Dj
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set facebook
     *
     * @param string $facebook
     * @return Dj
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;

        return $this;
    }

    /**
     * Get facebook
     *
     * @return string 
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * Set twitter
     *
     * @param string $twitter
     * @return Dj
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;

        return $this;
    }

    /**
     * Get twitter
     *
     * @return string 
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * Set googleplus
     *
     * @param string $googleplus
     * @return Dj
     */
    public function setGoogleplus($googleplus)
    {
        $this->googleplus = $googleplus;

        return $this;
    }

    /**
     * Get googleplus
     *
     * @return string 
     */
    public function getGoogleplus()
    {
        return $this->googleplus;
    }

    /**
     * Set youtube
     *
     * @param string $youtube
     * @return Dj
     */
    public function setYoutube($youtube)
    {
        $this->youtube = $youtube;

        return $this;
    }

    /**
     * Get youtube
     *
     * @return string 
     */
    public function getYoutube()
    {
        return $this->youtube;
    }

    /**
     * Set soundcloud
     *
     * @param string $soundcloud
     * @return Dj
     */
    public function setSoundcloud($soundcloud)
    {
        $this->soundcloud = $soundcloud;

        return $this;
    }

    /**
     * Get soundcloud
     *
     * @return string 
     */
    public function getSoundcloud()
    {
        return $this->soundcloud;
    }
}
