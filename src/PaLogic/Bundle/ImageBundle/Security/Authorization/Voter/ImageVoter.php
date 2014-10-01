<?php

namespace PaLogic\Bundle\ImageBundle\Security\Authorization\Voter;

use Symfony\Component\Security\Core\Exception\InvalidArgumentException;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authorization\Voter\RoleHierarchyVoter;

class ImageVoter implements VoterInterface
{
    const VIEW = 'view';
    const EDIT = 'edit';

    /**
     * @var type RoleHierarchyVoter
     */
    private $hierarchicalVoter;

    public function __construct(RoleHierarchyVoter $hierarchicalVoter) {
        $this->hierarchicalVoter = $hierarchicalVoter;
    }

    public function supportsAttribute($attribute)
    {
        return in_array($attribute, array(
            self::VIEW,
            self::EDIT,
        ));
    }

    public function supportsClass($class)
    {
        $supportedClass = 'PaLogic\Bundle\ImageBundle\Entity\Image';

        return $supportedClass === $class || is_subclass_of($class, $supportedClass);
    }

    /**
     * @var \PaLogic\Bundle\ImageBundle\Entity\Image $image
     */
    public function vote(TokenInterface $token, $image, array $attributes)
    {

        // check if class of this object is supported by this voter
        if (!$this->supportsClass(get_class($image))) {
            return VoterInterface::ACCESS_ABSTAIN;
        }

        // check if the voter is used correct, only allow one attribute
        // this isn't a requirement, it's just one easy way for you to
        // design your voter
        if(1 !== count($attributes)) {
            throw new InvalidArgumentException(
                'Only one attribute is allowed for VIEW or EDIT'
            );
        }

        // set the attribute to check against
        $attribute = $attributes[0];

        // get current logged in user
        $user = $token->getUser();

        // check if the given attribute is covered by this voter
        if (!$this->supportsAttribute($attribute)) {
            return VoterInterface::ACCESS_ABSTAIN;
        }

        // make sure there is a user object (i.e. that the user is logged in)
        if (!$user instanceof UserInterface) {
            return VoterInterface::ACCESS_DENIED;
        }

        if (VoterInterface::ACCESS_GRANTED == $this->hierarchicalVoter->vote($token, null, array("ROLE_ADMIN"))) {
            return VoterInterface::ACCESS_GRANTED;
        }
        if ($user->getId() === $image->getOwner()->getId()) {
            return VoterInterface::ACCESS_GRANTED;
        }

        switch($attribute) {
            case self::VIEW:
                return VoterInterface::ACCESS_GRANTED;
        }
        return VoterInterface::ACCESS_ABSTAIN;
    }
}