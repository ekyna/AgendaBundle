<?php

namespace Ekyna\Bundle\AgendaBundle\Dashboard;

use Ekyna\Bundle\AdminBundle\Dashboard\Widget\Type\AbstractWidgetType;
use Ekyna\Bundle\AdminBundle\Dashboard\Widget\WidgetInterface;
use Ekyna\Bundle\AgendaBundle\Entity\EventRepository;

/**
 * Class EventsWidgetType
 * @package Ekyna\Bundle\AgendaBundle\Dashboard
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class EventsWidgetType extends AbstractWidgetType
{
    /**
     * @var EventRepository
     */
    private $repository;


    /**
     * Constructor.
     *
     * @param EventRepository $repository
     */
    public function __construct(EventRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * {@inheritdoc}
     */
    public function render(WidgetInterface $widget, \Twig_Environment $twig)
    {
        $events = $this->repository->findBy(['enabled' => false], ['createdAt' => 'desc'], 6);

        return $twig->render('EkynaAgendaBundle:Admin/Dashboard:events.html.twig', array(
            'events' => $events,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'events';
    }
}
