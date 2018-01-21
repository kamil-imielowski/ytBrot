<?php

namespace AppBundle\Repository;

/**
 * MovieRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MovieRepository extends \Doctrine\ORM\EntityRepository
{
    function getLastMovies($limit) {
        return $this->createQueryBuilder('e')->
        orderBy('e.createdAt', 'DESC')->
        setMaxResults($limit)->getQuery()->getResult();
    }

    function findByNameLike($query) {
        return $this->createQueryBuilder('m')
            ->where("m.name LIKE '%$query%'")
            ->getQuery()
            ->getResult();
    }
}
