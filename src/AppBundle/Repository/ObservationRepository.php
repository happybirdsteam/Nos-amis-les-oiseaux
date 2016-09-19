<?php

namespace AppBundle\Repository;

/**
 * ObservationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ObservationRepository extends \Doctrine\ORM\EntityRepository
{

public function getMarkersBetween($latLngArray)
    {
        $qb = $this->createQueryBuilder('o')
            ->select('o.lat, o.lng')
            ->where('o.lat > :southwestlat')
                ->setParameter('southwestlat', $latLngArray[1])
            ->andWhere('o.lat < :northeastlat')
                ->setParameter('northeastlat', $latLngArray[3])
            ->andWhere('o.lng > :southwestlng')
                ->setParameter('southwestlng', $latLngArray[0])
            ->andWhere('o.lng < :northeastlng')
                ->setParameter('northeastlng', $latLngArray[2])
        ;


        return $qb
            ->getQuery()
            ->getResult();

    }
}
