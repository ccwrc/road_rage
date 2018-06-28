<?php

declare(strict_types=1);

namespace TruckBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

/**
 * UserRepository
 * Add your own custom repository methods below.
 */
class UserRepository extends EntityRepository
{
    public function findUsersByQuery(?string $pieceOfUsername, ?string $pieceOfEmail): Query
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();

        $qb->select('u');
        $qb->from('TruckBundle:User', 'u');

        if ($pieceOfUsername !== null) {
            $qb->andWhere(
                $qb->expr()->like('u.username', ":username")
            );
            $qb->setParameter("username", "%$pieceOfUsername%");
        }

        if ($pieceOfEmail !== null) {
            $qb->andWhere(
                $qb->expr()->like("u.email", ":pieceOfEmail")
            );
            $qb->setParameter("pieceOfEmail", "%$pieceOfEmail%");
        }

        return $query = $qb->getQuery();
    }
}
