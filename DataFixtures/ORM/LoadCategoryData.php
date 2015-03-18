<?php

namespace Ekyna\Bundle\AgendaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ekyna\Bundle\AgendaBundle\Entity\Category;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadCategoryData
 * @package Ekyna\Bundle\AgendaBundle\DataFixtures\ORM
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class LoadCategoryData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $om)
    {
        $category1 = new Category();
        $category1
            ->setName('Category test 1 name')
            ->setBackgroundColor('#428bca')
            ->setTextColor('#ffffff')
        ;
        $om->persist($category1);

        $category2 = new Category();
        $category2
            ->setName('Category test 2 name')
            ->setBackgroundColor('#d9534f')
            ->setTextColor('#ffffff')
        ;
        $om->persist($category2);

        $om->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 98;
    }
}
