<?php

namespace TruckBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * NoteRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class NoteRepository extends EntityRepository {

    public function findAllPublicNotesQuery() {
        $em = $this->getEntityManager();
        $query = $em->createQuery('SELECT n FROM TruckBundle:Note n WHERE n.timePublication'
                        . ' <= CURRENT_TIMESTAMP() AND n.status LIKE :public ORDER BY n.timePublication'
                        . ' DESC')->setParameter('public', 'public');
        return $query;
    }

}
