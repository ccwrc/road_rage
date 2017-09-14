<?php

namespace TruckBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * AccidentCaseRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AccidentCaseRepository extends EntityRepository {
    
    public function findAllActiveCases() {
        $em = $this->getEntityManager();
        $query = $em->createQuery('SELECT c FROM TruckBundle:AccidentCase c WHERE c.status '
                . 'LIKE :active')->setParameter("active", "active");
        return $query->getResult();
    }
    
    public function findAllInactiveCases() {
        $em = $this->getEntityManager();
        $query = $em->createQuery('SELECT c FROM TruckBundle:AccidentCase c WHERE c.status '
                . 'LIKE :inactive')->setParameter("inactive", "inactive");
        return $query->getResult();
    }    
    
    // all below to the end case report
    
    public function findFirstMonitoringStartByCaseId($caseId) {
        $em = $this->getEntityManager();
        $query = $em->createQuery('SELECT m FROM TruckBundle:Monitoring m WHERE m.accidentCase'
                . ' = :caseId AND m.code = :code ORDER BY m.timeSave ASC')
                ->setMaxResults(1)
                ->setParameter("caseId", $caseId)
                ->setParameter("code", "START");
        return $query->getResult();
    }   
    
    public function findLastMonitoringEtaByCaseId($caseId) {
        $em = $this->getEntityManager();
        $query = $em->createQuery('SELECT m FROM TruckBundle:Monitoring m WHERE m.accidentCase'
                . ' = :caseId AND m.code = :code ORDER BY m.timeSave DESC')
                ->setMaxResults(1)
                ->setParameter("caseId", $caseId)
                ->setParameter("code", "ETA");
        return $query->getResult();
    }       
    
    public function findLastMonitoringStrrByCaseId($caseId) {
        $em = $this->getEntityManager();
        $query = $em->createQuery('SELECT m FROM TruckBundle:Monitoring m WHERE m.accidentCase'
                . ' = :caseId AND m.code = :code ORDER BY m.timeSave DESC')
                ->setMaxResults(1)
                ->setParameter("caseId", $caseId)
                ->setParameter("code", "STRR");
        return $query->getResult();
    }      
    
    public function findLastMonitoringEndByCaseId($caseId) {
        $em = $this->getEntityManager();
        $query = $em->createQuery('SELECT m FROM TruckBundle:Monitoring m WHERE m.accidentCase'
                . ' = :caseId AND m.code = :code ORDER BY m.timeSave DESC')
                ->setMaxResults(1)
                ->setParameter("caseId", $caseId)
                ->setParameter("code", "END");
        return $query->getResult();
    }      
    
}
