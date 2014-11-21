<?php

namespace PaLogic\Bundle\BlogBundle\Twig;

class BlogExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('shorten', array($this, 'shortenFilter')),
        );
    }

    public function shortenFilter($text, $length = 50)
    {
        $tags = array("<p>", "</p>");
        foreach ($tags as $tag) {
            $text = str_replace($tag, "", $text);
        }
        $shortText = substr($text, 0, $length);
        if (strlen($text) > $length) {
            $shortText = $shortText."... ";
        }
        return $shortText;
    }

    public function getName()
    {
        return 'blog_extension';
    }
}