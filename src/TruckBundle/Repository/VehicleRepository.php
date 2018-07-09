<?php

declare(strict_types=1);

namespace TruckBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

/**
 * VehicleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class VehicleRepository extends EntityRepository
{

    public function findVehiclesByDealerIdQuery(int $dealerId): Query
    {
        $em = $this->getEntityManager();

        return $em->createQuery('SELECT v FROM TruckBundle:Vehicle v JOIN v.dealer d WHERE'
            . ' d.id = :dealerId ORDER BY v.companyName ASC')
            ->setParameter('dealerId', $dealerId);
    }

    public function findAllVehiclesByQuery(
        ?string $companyName,
        ?string $city,
        ?string $street,
        ?string $registrationNumber
    ): Query
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();

        $qb->select('v');
        $qb->from('TruckBundle:Vehicle', 'v');
        $qb->orderBy('v.companyName', 'ASC');

        if ($companyName !== null) {
            $qb->andWhere(
                $qb->expr()->like('v.companyName', ':companyName')
            );
            $qb->setParameter('companyName', "%$companyName%");
        }

        if ($city !== null) {
            $qb->andWhere(
                $qb->expr()->like('v.city', ':city')
            );
            $qb->setParameter('city', "%$city%");
        }

        if ($street !== null) {
            $qb->andWhere(
                $qb->expr()->like('v.street', ':street')
            );
            $qb->setParameter('street', "%$street%");
        }

        if ($registrationNumber !== null) {
            $qb->andWhere(
                $qb->expr()->like('v.registrationNumber', ':registrationNumber')
            );
            $qb->setParameter('registrationNumber', "%$registrationNumber%");
        }

        return $qb->getQuery();
    }
}
