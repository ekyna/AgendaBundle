<?php

namespace Ekyna\Bundle\AgendaBundle\Entity;

use Doctrine\DBAL\Types\Type;
use Ekyna\Bundle\AdminBundle\Doctrine\ORM\ResourceRepository;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;

/**
 * Class EventRepository
 * @package Ekyna\Bundle\AgendaBundle\Entity
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class EventRepository extends ResourceRepository
{
    /**
     * Returns the events pager.
     *
     * @param integer $currentPage
     * @param integer $maxPerPage
     * @param array   $categories
     * @param bool    $includePrivate
     * @return Pagerfanta
     */
    public function createPager($currentPage, $maxPerPage = 12, array $categories = array(), $includePrivate = false)
    {
        $qb = $this->createQueryBuilder('e');
        $params = ['enabled' => true];
        $qb
            ->addOrderBy('e.startDate', 'DESC')
            ->andWhere($qb->expr()->eq('e.enabled', ':enabled'))
        ;

        $cateParam = [];
        foreach ($categories as $category) {
            if ($category instanceof Category) {
                $cateParam[] = $category;
            }
        }
        if (0 < count($cateParam)) {
            $qb->andWhere($qb->expr()->in('e.category', ':categories'));
            $params['categories'] = $cateParam;
        }

        if (!$includePrivate) {
            $qb->andWhere($qb->expr()->eq('e.private', ':private'));
            $params['private'] = false;
        }

        $query = $qb->getQuery();
        $query->setParameters($params);

        $pager = new Pagerfanta(new DoctrineORMAdapter($query));
        $pager
            ->setNormalizeOutOfRangePages(true)
            ->setMaxPerPage($maxPerPage)
            ->setCurrentPage($currentPage)
        ;

        return $pager;
    }

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

        $qb = $this->createQueryBuilder('e');

        $query = $qb
            ->andWhere($qb->expr()->eq('e.enabled', ':enabled'))
            ->andWhere($qb->expr()->eq('e.slug', ':slug'))
            ->getQuery()
        ;

        return $query
            ->setMaxResults(1)
            ->setParameters(array(
                'enabled' => true,
                'slug' => $slug,
            ))
            ->getOneOrNullResult()
        ;
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

        $qb = $this->createQueryBuilder('e');
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

        $qb = $this->createQueryBuilder('e');
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
