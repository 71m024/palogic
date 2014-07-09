<?php

namespace PaLogic\Bundle\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="PaLogic\Bundle\BlogBundle\Entity\Repository\TagRepository")
 * @ORM\Table(name="tag")
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity(fields="tag")
 */
class Tag {
    
   /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length=20, unique=true)
     */
    protected $tag;
    
    /**
     * @ORM\ManyToMany(targetEntity="PaLogic\Bundle\BlogBundle\Entity\Post", mappedBy="tags")
     * */
    protected $posts;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->postTags = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    public function __toString() {
        return $this->tag;
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
     * Set tag
     *
     * @param string $tag
     * @return Tag
     */
    public function setTag($tag)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return string 
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Add posts
     *
     * @param \PaLogic\Bundle\BlogBundle\Entity\Post $posts
     * @return Tag
     */
    public function addPost(\PaLogic\Bundle\BlogBundle\Entity\Post $posts)
    {
        $this->posts[] = $posts;

        return $this;
    }

    /**
     * Remove posts
     *
     * @param \PaLogic\Bundle\BlogBundle\Entity\Post $posts
     */
    public function removePost(\PaLogic\Bundle\BlogBundle\Entity\Post $posts)
    {
        $this->posts->removeElement($posts);
    }

    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPosts()
    {
        return $this->posts;
    }
}
