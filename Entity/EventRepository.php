<?php

namespace Ekyna\Bundle\AgendaBundle\Entity;

use Doctrine\DBAL\Types\Type;
use Ekyna\Bundle\AdminBundle\Doctrine\ORM\ResourceRepository;

/**
 * Class EventRepository
 * @package Ekyna\Bundle\AgendaBundle\Entity
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class EventRepository extends ResourceRepository
{
    /**
     * Finds the events by date range.
     *
     * @param \DateTime $startDate
     * @param \DateTime $endDate
     * @param bool|null $private
     * @return Event[]
     */
    public function findByDateRange(\DateTime $startDate, \DateTime $endDate, $private = null)
    {
        $qb = $this
            ->createQueryBuilder('e')
            ->join('e.category', 'c')
        ;

        $qb
            ->andWhere($qb->expr()->gte('e.startDate', ':startDate'))
            ->andWhere($qb->expr()->lte('e.endDate', ':endDate'))
            ->setParameter('startDate', $startDate, Type::DATETIME)
            ->setParameter('endDate', $endDate, Type::DATETIME)
        ;
        if (null !== $private) {
            $qb
                ->andWhere($qb->expr()->gte('e.private', ':private'))
                ->setParameter('private', $private, Type::BOOLEAN)
            ;
        }

        return $qb
            ->getQuery()
            ->getResult()
        ;
    }
}
