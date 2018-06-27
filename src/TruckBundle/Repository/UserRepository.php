<?php

declare(strict_types=1);

namespace TruckBundle\Repository;

use Doctrine\ORM\EntityRepository;
use TruckBundle\Entity\User;

/**
 * UserRepository
 * Add your own custom repository methods below.
 */
class UserRepository extends EntityRepository
{
    /**
     * @param string $email
     * @return User[]
     */
    public function findUsersByPieceOfEmail(string $email): array
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery('SELECT u FROM TruckBundle:User u WHERE u.email '
            . 'LIKE :email')->setParameter('email', "%$email%");
        return $query->getResult();
    }

    /**
     * @param string $username
     * @return User[]
     */
    public function findUsersByPieceOfUsername(string $username): array
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery('SELECT u FROM TruckBundle:User u WHERE u.username '
            . 'LIKE :username')->setParameter('username', "%$username%");
        return $query->getResult();
    }
}
