<?php

namespace PaLogic\Bundle\DjBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Genre
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PaLogic\Bundle\DjBundle\Entity\Repository\GenreRepository")
 */
class Genre
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
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="PaLogic\Bundle\DjBundle\Entity\Dj", mappedBy="genres")
     */
    private $djs;
    
    public function __toString() {
        return $this->name;
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
     * @return Genre
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
     * Constructor
     */
    public function __construct()
    {
        $this->subGenres = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Genre
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
     * @return Genre
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
     * Add djs
     *
     * @param \PaLogic\Bundle\DjBundle\Entity\Dj $djs
     * @return Genre
     */
    public function addDj(\PaLogic\Bundle\DjBundle\Entity\Dj $djs)
    {
        $this->djs[] = $djs;

        return $this;
    }

    /**
     * Remove djs
     *
     * @param \PaLogic\Bundle\DjBundle\Entity\Dj $djs
     */
    public function removeDj(\PaLogic\Bundle\DjBundle\Entity\Dj $djs)
    {
        $this->djs->removeElement($djs);
    }

    /**
     * Get djs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDjs()
    {
        return $this->djs;
    }
}
