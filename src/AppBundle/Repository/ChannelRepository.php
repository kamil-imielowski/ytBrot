<?php

namespace AppBundle\Repository;

/**
 * ChannelRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ChannelRepository extends \Doctrine\ORM\EntityRepository
{
    function findByNameLike($query) {
        return $this->createQueryBuilder('ch')
            ->where("ch.name LIKE '%$query%'")
            ->getQuery()
            ->getResult();
    }
}
