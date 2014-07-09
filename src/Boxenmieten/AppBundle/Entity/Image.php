<?php

namespace Boxenmieten\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Boxenmieten\AppBundle\Util\SlugUtil;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Image
 *
 * @ORM\Table(name="image")
 * @ORM\Entity(repositoryClass="Boxenmieten\AppBundle\Entity\Repository\ImageRepository")
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
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime")
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
     */
    private $file;
    
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
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
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
        $this->setUpdatedValue();
        $this->upload();
    }
    
    /**
     * @ORM\PreUpdate
     */
    public function onPreUpdate() {
        $this->setUpdatedValue();
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
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        
        /*Dirty workaround to change something mapped in this entity*/
        if ($file instanceof UploadedFile) {
            $this->setUpdatedValue();
        }
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

        // we use the original file name here but you should
        // sanitize it at least to avoid any security issues

        // move takes the target directory and target filename as params
        $this->getFile()->move(
            $this->getUploadRootDir(),
            $this->getFile()->getClientOriginalName()
        );

        // set the path property to the filename where you've saved the file
        $this->setFilename($this->getFile()->getClientOriginalName());

        // clean up the file property as you won't need it anymore
        $this->setFile(null);
    }
    
    public function setUpdatedValue() {
        $this->updated = new \DateTime();
        if ($this->created === null) {
            $this->created = $this->updated;
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
        
        $this->setSlug(SlugUtil::slugify($title));

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
}
