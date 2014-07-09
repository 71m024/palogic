<?php

namespace PaLogic\Bundle\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use PaLogic\Bundle\BlogBundle\Entity\Tag;

class PostFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $tag1 = new Tag();
        $tag1->setTag("Kuh");
        $tag2 = new Tag();
        $tag2->setTag("Huhn");
        $tag3 = new Tag();
        $tag3->setTag("Mehlwurm");
        $manager->merge($this->getReference("post-1"))->addTag($tag1);
        $manager->merge($this->getReference("post-1"))->addTag($tag2);
        $manager->merge($this->getReference("post-2"))->addTag($tag2);
        $manager->merge($this->getReference("post-2"))->addTag($tag3);
        
        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}