<?php
// src/Blogger/BlogBundle/Form/EnquiryType.php

namespace PaLogic\Bundle\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
        $builder->add('email', 'email');
        $builder->add('tel');
        $builder->add('body', 'textarea');
        $builder->add('send', 'submit');
    }

    public function getName()
    {
        return 'contact';
    }
}