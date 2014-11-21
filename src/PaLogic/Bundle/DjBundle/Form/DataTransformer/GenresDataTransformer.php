<?php

/*
 * Stepan Tanasiychuk is the author of the original implementation
 * see: https://github.com/stfalcon/BlogBundle/blob/master/Bridge/Doctrine/Form/DataTransformer/EntitiesToStringTransformer.php
 */

namespace PaLogic\Bundle\DjBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use PaLogic\Bundle\DjBundle\Entity\Genre;

/**
 * Genres DataTransformer.
 */
class GenresDataTransformer implements DataTransformerInterface
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var SecurityContextInterface
     */
    private $securityContext;


    /**
     * Ctor.
     *
     * @param RegistryInterface        $registry        A RegistryInterface instance
     * @param SecurityContextInterface $securityContext A SecurityContextInterface instance
     */
    public function __construct(RegistryInterface $registry, SecurityContextInterface $securityContext)
    {
        $this->em = $registry->getManager();
        $this->securityContext = $securityContext;
    }

    /**
     * Convert string of genres to array.
     *
     * @param string $string
     *
     * @return array
     */
    private function stringToArray($string)
    {
        $genres = explode(',', $string);

        // strip whitespaces from beginning and end of a tag text
        foreach ($genres as &$text) {
            $text = trim($text);
        }

        // removes duplicates
        return array_unique($genres);
    }

    /**
     * Transforms genres entities into string (separated by comma).
     *
     * @param Collection | null $genreCollection A collection of entities or NULL
     *
     * @return string | null An string of genres or NULL
     * @throws UnexpectedTypeException
     */
    public function transform($genreCollection)
    {
        if (null === $genreCollection) {
            return null;
        }

        if (!($genreCollection instanceof Collection)) {
            throw new UnexpectedTypeException($genreCollection, 'Doctrine\Common\Collections\Collection');
        }

        $genres = array();

        /**
         * @var \PaLogic\Bundle\DjBundle\Entity\Genre $genre
         */
        foreach ($genreCollection as $genre) {
            array_push($genres, $genre->getName());
        }

        return implode(', ', $genres);
    }

    /**
     * Transforms string into genres entities.
     *
     * @param string | null $data Input string data
     *
     * @return Collection | null
     * @throws UnexpectedTypeException
     * @throws AccessDeniedException
     */
    public function reverseTransform($data)
    {
        if (!$this->securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            throw new AccessDeniedException('Für das Speichern von Genres muss man registriert sein.');
        }

        $genreCollection = new ArrayCollection();

        if ('' === $data || null === $data) {
            return $genreCollection;
        }

        if (!is_string($data)) {
            throw new UnexpectedTypeException($data, 'string');
        }

        foreach ($this->stringToArray($data) as $name) {

            $genre = $this->em->getRepository('PaLogicDjBundle:Genre')
                ->findOneBy(array('name' => $name));

            if (null === $genre) {
                $genre = new Genre();
                $genre->setName($name);

                $this->em->persist($genre);
            }

            $genreCollection->add($genre);

        }

        return $genreCollection;
    }
}