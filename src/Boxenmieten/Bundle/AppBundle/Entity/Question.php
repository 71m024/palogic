<?php

namespace Boxenmieten\Bundle\AppBundle\Entity;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;

class Question
{
    
    /**
     * @NotBlank(message="Der Name muss angegeben werden.")
     */
    protected $name;

    /**
     * @Email(message="Die E-Mail Adresse ist ungültig.", checkMX=true, checkHost=true)
     */
    protected $email;
    
    protected $tel;
    
    protected $body;
    
    protected $send;

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getTel()
    {
        return $this->tel;
    }

    public function setTel($tel)
    {
        $this->tel = $tel;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function setBody($body)
    {
        $this->body = $body;
    }
    
    public function getSend()
    {
        return $this->send;
    }
    
    public function setSend($send)
    {
        $this->send = $send;
    }
}