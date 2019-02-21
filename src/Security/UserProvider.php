<?php

namespace App\Security;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;



class UserProvider implements UserProviderInterface
{

    private $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    )
    {
        $this->entityManager = $entityManager;
    }

    public function loadUserByUsername($username)
    {
        return $this->entityManager->createQueryBuilder('u')
            ->where('u.email = :email')
            ->setParameter('email', $username)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User){
            throw new UnsupportedUserException(
                sprintf('Instancia "%s" não suportada.' 
                . get_class($user))
            );
        }

        return $user;
    }

    public function supportsClass($class)
    {
        return $class === 'App\Security\User';
    }
}