<?php

namespace Ekyna\Bundle\AgendaBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

/**
 * Class AdminMenuPass
 * @package Ekyna\Bundle\AgendaBundle\DependencyInjection\Compiler
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class AdminMenuPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('ekyna_admin.menu.pool')) {
            return;
        }

        $pool = $container->getDefinition('ekyna_admin.menu.pool');

        $pool->addMethodCall('createGroup', array(array(
            'name'     => 'agenda',
            'label'    => 'ekyna_agenda.label',
            'icon'     => 'calendar',
            'position' => 98,
        )));
        $pool->addMethodCall('createEntry', array('agenda', array(
            'name'     => 'events',
            'route'    => 'ekyna_agenda_event_admin_home',
            'label'    => 'ekyna_agenda.event.label.plural',
            'resource' => 'ekyna_agenda_event',
            'position' => 1,
        )));
        $pool->addMethodCall('createEntry', array('agenda', array(
            'name'     => 'categories',
            'route'    => 'ekyna_agenda_category_admin_home',
            'label'    => 'ekyna_agenda.category.label.plural',
            'resource' => 'ekyna_agenda_category',
            'position' => 2,
        )));
    }
}
