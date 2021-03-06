<?php

declare(strict_types=1);

namespace TruckBundle\Repository;

use Doctrine\ORM\EntityRepository;

use TruckBundle\Entity\Monitoring;

/**
 * MonitoringRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MonitoringRepository extends EntityRepository
{

    /**
     * @param int $caseId
     * @return Monitoring[]
     */
    public function findMonitoringsByCaseId(int $caseId): array
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery('SELECT m FROM TruckBundle:Monitoring m WHERE m.accidentCase'
            . ' = :caseId')->setParameter('caseId', $caseId);
        return $query->getResult();
    }

    // (start) for end case report
    public function findFirstMonitoringStartByCaseId(int $caseId): ?Monitoring
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery('SELECT m FROM TruckBundle:Monitoring m WHERE m.accidentCase'
            . ' = :caseId AND m.code = :code ORDER BY m.timeSave ASC')
            ->setMaxResults(1)
            ->setParameter('caseId', $caseId)
            ->setParameter('code', Monitoring::$codeStart);
        return $query->getOneOrNullResult();
    }

    public function findLastMonitoringEtaByCaseId(int $caseId): ?Monitoring
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery('SELECT m FROM TruckBundle:Monitoring m WHERE m.accidentCase'
            . ' = :caseId AND m.code = :code ORDER BY m.timeSave DESC')
            ->setMaxResults(1)
            ->setParameter('caseId', $caseId)
            ->setParameter('code', Monitoring::$codeEta);
        return $query->getOneOrNullResult();
    }

    public function findLastMonitoringStrrByCaseId(int $caseId): ?Monitoring
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery('SELECT m FROM TruckBundle:Monitoring m WHERE m.accidentCase'
            . ' = :caseId AND m.code = :code ORDER BY m.timeSave DESC')
            ->setMaxResults(1)
            ->setParameter('caseId', $caseId)
            ->setParameter('code', Monitoring::$codeStrr);
        return $query->getOneOrNullResult();
    }

    public function findLastMonitoringEndByCaseId(int $caseId): ?Monitoring
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery('SELECT m FROM TruckBundle:Monitoring m WHERE m.accidentCase'
            . ' = :caseId AND m.code = :code ORDER BY m.timeSave DESC')
            ->setMaxResults(1)
            ->setParameter('caseId', $caseId)
            ->setParameter('code', Monitoring::$codeEnd);
        return $query->getOneOrNullResult();
    }

    public function findLastMonitoringRoByCaseId(int $caseId): ?Monitoring
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery('SELECT m FROM TruckBundle:Monitoring m WHERE m.accidentCase'
            . ' = :caseId AND m.code = :code ORDER BY m.timeSave DESC')
            ->setMaxResults(1)
            ->setParameter('caseId', $caseId)
            ->setParameter('code', Monitoring::$codeRo);
        return $query->getOneOrNullResult();
    }

    public function findLastMonitoringPgByCaseId(int $caseId): ?Monitoring
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery('SELECT m FROM TruckBundle:Monitoring m WHERE m.accidentCase'
            . ' = :caseId AND m.code = :code ORDER BY m.timeSave DESC')
            ->setMaxResults(1)
            ->setParameter('caseId', $caseId)
            ->setParameter('code', Monitoring::$codePg);
        return $query->getOneOrNullResult();
    }

    public function findLastMonitoringCpgByCaseId(int $caseId): ?Monitoring
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery('SELECT m FROM TruckBundle:Monitoring m WHERE m.accidentCase'
            . ' = :caseId AND m.code = :code ORDER BY m.timeSave DESC')
            ->setMaxResults(1)
            ->setParameter('caseId', $caseId)
            ->setParameter('code', Monitoring::$codeCpg);
        return $query->getOneOrNullResult();
    }
    // (end) for end case report
}
