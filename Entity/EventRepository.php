<?php

namespace Ekyna\Bundle\AgendaBundle\Entity;

use Doctrine\DBAL\Types\Type;
use Ekyna\Bundle\AdminBundle\Doctrine\ORM\TranslatableResourceRepository;

/**
 * Class EventRepository
 * @package Ekyna\Bundle\AgendaBundle\Entity
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class EventRepository extends TranslatableResourceRepository
{
    /**
     * Finds one event by slug.
     *
     * @param string $slug
     * @return Event|null
     */
    public function findOneBySlug($slug)
    {
        if (0 == strlen($slug)) {
            return null;
        }

        return $this->findOneBy(array(
            'enabled' => true,
            'slug' => $slug
        ));
    }

    /**
     * Finds the upcoming events.
     *
     * @param int $limit
     * @return Event[]
     */
    public function findUpComing($limit = 3)
    {
        $today = new \DateTime();
        $today->setTime(0,0,0);

        $qb = $this->getCollectionQueryBuilder();
        $query = $qb
            ->andWhere($qb->expr()->eq('e.enabled', ':enabled'))
            ->andWhere($qb->expr()->gte('e.startDate', ':today'))
            ->addOrderBy('e.startDate', 'ASC')
            ->getQuery()
        ;

        return $query
            ->setMaxResults($limit)
            ->setParameter('enabled', true)
            ->setParameter('today', $today, Type::DATETIME)
            ->getResult()
        ;
    }

    /**
     * Finds the latest events.
     *
     * @param int $limit
     * @return Event[]
     */
    public function findLatest($limit = 3)
    {
        $today = new \DateTime();
        $today->setTime(23,59,59);

        $qb = $this->getCollectionQueryBuilder();
        $query = $qb
            ->andWhere($qb->expr()->eq('e.enabled', ':enabled'))
            ->andWhere($qb->expr()->lte('e.endDate', ':today'))
            ->addOrderBy('e.endDate', 'DESC')
            ->getQuery()
        ;

        return $query
            ->setMaxResults($limit)
            ->setParameter('enabled', true)
            ->setParameter('today', $today, Type::DATETIME)
            ->getResult()
        ;
    }

    /**
     * Finds the events by date range.
     *
     * @param \DateTime $startDate
     * @param \DateTime $endDate
     * @return Event[]
     */
    public function findByDateRange(\DateTime $startDate, \DateTime $endDate)
    {
        $qb = $this
            ->getCollectionQueryBuilder()
            ->join('e.category', 'c')
        ;

        $qb
            ->andWhere($qb->expr()->gte('e.startDate', ':startDate'))
            ->andWhere($qb->expr()->lte('e.endDate', ':endDate'))
            ->setParameter('startDate', $startDate, Type::DATETIME)
            ->setParameter('endDate', $endDate, Type::DATETIME)
        ;

        return $qb
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function getAlias()
    {
        return 'e';
    }
}
