<?php

namespace PaLogic\Bundle\ImageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Image
 *
 * @ORM\Table(name="image")
 * @ORM\Entity(repositoryClass="PaLogic\Bundle\ImageBundle\Entity\Repository\ImageRepository")
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity(fields="filename")
 * @UniqueEntity(fields="title")
 */
class Image
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
     * @var string
     *
     * @ORM\Column(name="filename", type="string", length=255, unique=true)
     */
    private $filename;
    
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
     * @ORM\Column(name="title", type="string", length=50, unique=true)
     */
    private $title;
    
     /**
     * @ORM\Column(type="string")
     * @Gedmo\Slug(fields={"title"})
     */
    protected $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * Unmapped property to handle file uploads
     * @Assert\File(maxSize="6000000")
     */
    private $file;
    
    /**
     * @ORM\ManyToOne(targetEntity="PaLogic\Bundle\UserBundle\Entity\PaUser")
     */
    private $owner;
    
    public function __toString() {
        return $this->title;
    }
    
    public function getAbsolutePath()
    {
        return null === $this->filename
            ? null
            : $this->getUploadRootDir().'/'.$this->filename;
    }

    public function getWebPath()
    {
        return null === $this->filename
            ? null
            : '/'.$this->getUploadDir().'/'.$this->filename;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads';
    }
    
    /**
     * @ORM\PrePersist
     */
    public function onPrePersist() {
        $this->upload();
    }
    
    /**
     * @ORM\PreUpdate
     */
    public function onPreUpdate() {
        $this->upload();
    }
    
    /**
     * @ORM\PreRemove()
     */
    public function onPreRemove() {
        $this->removeFile();
    }
    
    private function removeFile() {
        if (!empty($this->filename)) {
            unlink($this->getAbsolutePath());
        }
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     * @return Image
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Manages the copying of the file to the relevant place on the server
     */
    public function upload()
    {   
        // the file property can be empty if the field is not required
        if (null === $this->getFile()) {
            return;
        }

        /* remove old file */
        if ($this->filename != null) {
            $this->removeFile();
        }
        
        $fileExtension = $this->getFile()->getClientOriginalExtension();
        $now = new \DateTime('now');
        $filename = $now->getTimestamp() . rand(0, 9999) . "." . $fileExtension;

        // move takes the target directory and target filename as params
        $this->getFile()->move(
            $this->getUploadRootDir(),
            $filename
        );

        // set the path property to the filename where you've saved the file
        $this->setFilename($filename);

        // clean up the file property as you won't need it anymore
        $this->setFile(null);
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
     * Set created
     *
     * @param \DateTime $created
     * @return Image
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
     * @return Image
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
     * Set title
     *
     * @param string $title
     * @return Image
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
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
     * Set description
     *
     * @param string $description
     * @return Image
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
     * Set slug
     *
     * @param string $slug
     * @return Image
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
     * Set filename
     *
     * @param string $filename
     * @return Image
     */
    public function setFilename($filename)
    {
        /*dirty remove old file*/
        $this->removeFile();
        
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string 
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set owner
     *
     * @param \PaLogic\Bundle\UserBundle\Entity\PaUser $owner
     * @return Image
     */
    public function setOwner(\PaLogic\Bundle\UserBundle\Entity\PaUser $owner = null)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return \PaLogic\Bundle\UserBundle\Entity\PaUser 
     */
    public function getOwner()
    {
        return $this->owner;
    }
}
