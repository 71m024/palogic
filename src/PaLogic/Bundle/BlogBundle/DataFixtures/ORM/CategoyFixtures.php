<?php

namespace PaLogic\Bundle\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use PaLogic\Bundle\BlogBundle\Entity\Category;
use Doctrine\Common\DataFixtures\AbstractFixture;

class CategoyFixtures extends AbstractFixture implements OrderedFixtureInterface{
    public function getOrder() {
        return 4;
    }

    public function load(ObjectManager $manager) {
        
        $category1 = new Category();
        $category1->setName("Allgemein");
        
        $category2 = new Category();
        $category2->setName("Boxen");
        
        $category3 = new Category();
        $category3->setName("RandomShit");
        
        $manager->merge($this->getReference('post-1'))->addCategory($category1);
        $manager->merge($this->getReference('post-1'))->addCategory($category2);
        $manager->merge($this->getReference('post-2'))->addCategory($category1);
        $manager->merge($this->getReference('post-2'))->addCategory($category3);
        
        $manager->flush();
    }
}
