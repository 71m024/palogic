<?php

namespace Boxenmieten\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Boxenmieten\BlogBundle\Entity\Comment;

/**
 * Description of CommentFixtures
 *
 * @author Timo
 */
class CommentFixtures extends AbstractFixture implements OrderedFixtureInterface{
    public function getOrder() {
        return 3;
    }

    public function load(\Doctrine\Common\Persistence\ObjectManager $manager) {
        
        $comment = new Comment();
        $comment->setComment("Lol!");
        $comment->setUser("71m024");
        $comment->setPost($manager->merge($this->getReference('post-1')));
        $manager->persist($comment);
        
        $comment = new Comment();
        $comment->setComment("Huere dr Shit..!");
        $comment->setUser("Tuxes3");
        $comment->setPost($manager->merge($this->getReference('post-1')));
        $manager->persist($comment);
        
        $comment = new Comment();
        $comment->setComment("schäbig.");
        $comment->setUser("Ramibu");
        $comment->setPost($manager->merge($this->getReference('post-2')));
        $manager->persist($comment);
        
        $manager->flush();
    }
}
