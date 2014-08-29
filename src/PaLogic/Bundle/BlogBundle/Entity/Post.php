<?php

namespace PaLogic\Bundle\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use PaLogic\Bundle\AppBundle\Util\SlugUtil;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="PaLogic\Bundle\BlogBundle\Entity\Repository\PostRepository")
 * @ORM\Table(name="post")
 * @ORM\HasLifecycleCallbacks
 */
class Post
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string")
     * @Gedmo\Slug(fields={"title"})
     */
    protected $slug;

    /**
     * @ORM\Column(type="string")
     */
    protected $title;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $author;
    
    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\Length(
     *      min = "10",
     *      max = "100",
     *      minMessage = "Your headline must be at least {{ limit }} characters long.",
     *      maxMessage = "Your headline cannot be longer than {{ limit }} characters."
     * )
     */
    protected $headline;

    /**
     * @ORM\Column(type="text")
     */
    protected $text;
    
    /**
     * @ORM\Column(type="string")
     */
    private $textFormatter;
    
    /**
     * @ORM\Column(type="text")
     */
    private $rawText;

    /**
     * @ORM\ManyToOne(targetEntity="PaLogic\Bundle\ImageBundle\Entity\Image")
     */
    protected $image;

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="post", cascade={"persist", "remove"})
     */
    protected $comments;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    protected $created;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    protected $updated;
    
    /**
     * @ORM\ManyToMany(targetEntity="PaLogic\Bundle\BlogBundle\Entity\Tag", inversedBy="posts", cascade={"persist"})
     */
    protected $tags;
    
    /**
     *  @ORM\ManyToMany(targetEntity="Category", inversedBy="posts", cascade={"persist"})
     */
    private $categories;
    
    /**
     * @ORM\ManyToOne(targetEntity="PaLogic\Bundle\AppBundle\Entity\DomainRoutePrefix")
     */
    protected $domainRoutePrefix;
    
    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }
    
    public function __toString()
    {
        return $this->getTitle();
    }
    
    public function getRawText() {
        return $this->rawText;
    }
    
    public function getTextFormatter() {
        return $this->textFormatter;
    }
    
    public function setRawText($text) {
        $this->rawText = $text;
    }
    
    public function setTextFormatter($text) {
        $this->textFormatter = $text;
    }
        

    /**
     * Set title
     *
     * @param string $title
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }


    /**
     * Get blog
     *
     * @return string 
     */
    public function getText($length = null)
    {
        if (false === is_null($length) && $length > 0) {
            return substr($this->text, 0, $length);
        }
        else {
            return $this->text;
        }
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
     * @return Post
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
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set author
     *
     * @param string $author
     * @return Post
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set text
     *
     * @param string $text
     * @return Post
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Post
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Post
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
     * @return Post
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
     * Add comments
     *
     * @param \PaLogic\Bundle\BlogBundle\Entity\Comment $comments
     * @return Post
     */
    public function addComment(\PaLogic\Bundle\BlogBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \PaLogic\Bundle\BlogBundle\Entity\Comment $comments
     */
    public function removeComment(\PaLogic\Bundle\BlogBundle\Entity\Comment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Add tags
     *
     * @param \PaLogic\Bundle\BlogBundle\Entity\Tag $tags
     * @return Post
     */
    public function addTag(\PaLogic\Bundle\BlogBundle\Entity\Tag $tags)
    {
        $this->tags[] = $tags;

        return $this;
    }

    /**
     * Remove tags
     *
     * @param \PaLogic\Bundle\BlogBundle\Entity\Tag $tags
     */
    public function removeTag(\PaLogic\Bundle\BlogBundle\Entity\Tag $tags)
    {
        $this->tags->removeElement($tags);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Add categories
     *
     * @param \PaLogic\Bundle\BlogBundle\Entity\Category $categories
     * @return Post
     */
    public function addCategory(\PaLogic\Bundle\BlogBundle\Entity\Category $categories)
    {
        $this->categories[] = $categories;

        return $this;
    }

    /**
     * Remove categories
     *
     * @param \PaLogic\Bundle\BlogBundle\Entity\Category $categories
     */
    public function removeCategory(\PaLogic\Bundle\BlogBundle\Entity\Category $categories)
    {
        $this->categories->removeElement($categories);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Set headline
     *
     * @param string $headline
     * @return Post
     */
    public function setHeadline($headline)
    {
        $this->headline = $headline;

        return $this;
    }

    /**
     * Get headline
     *
     * @return string 
     */
    public function getHeadline()
    {
        return $this->headline;
    }

    /**
     * Set domainRoutePrefix
     *
     * @param \PaLogic\Bundle\AppBundle\Entity\DomainRoutePrefix $domainRoutePrefix
     * @return Post
     */
    public function setDomainRoutePrefix(\PaLogic\Bundle\AppBundle\Entity\DomainRoutePrefix $domainRoutePrefix = null)
    {
        $this->domainRoutePrefix = $domainRoutePrefix;

        return $this;
    }

    /**
     * Get domainRoutePrefix
     *
     * @return \PaLogic\Bundle\AppBundle\Entity\DomainRoutePrefix 
     */
    public function getDomainRoutePrefix()
    {
        return $this->domainRoutePrefix;
    }
}
