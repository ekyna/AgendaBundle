<?php

namespace Ekyna\Bundle\AgendaBundle\Table\Type;

use Ekyna\Bundle\AdminBundle\Table\Type\ResourceTableType;
use Ekyna\Component\Table\TableBuilderInterface;

/**
 * Class EventType
 * @package Ekyna\Bundle\AgendaBundle\Table\Type
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class EventType extends ResourceTableType
{
    /**
     * {@inheritdoc}
     */
    public function buildTable(TableBuilderInterface $builder, array $options)
    {
        $builder
            ->addColumn('title', 'anchor', [
                'label' => 'ekyna_core.field.title',
                'sortable' => true,
                'route_name' => 'ekyna_agenda_event_admin_show',
                'route_parameters_map' => [
                    'eventId' => 'id'
                ],
            ])
            ->addColumn('startDate', 'datetime', [
                'label' => 'ekyna_core.field.start_date',
                'sortable' => true,
            ])
            ->addColumn('endDate', 'datetime', [
                'label' => 'ekyna_core.field.end_date',
                'sortable' => true,
            ])
            ->addColumn('enabled', 'boolean', [
                'label' => 'ekyna_core.field.enabled',
                'sortable' => true,
                'route_name' => 'ekyna_agenda_event_admin_toggle',
                'route_parameters_map' => [
                    'eventId' => 'id',
                ],
            ])
            ->addColumn('actions', 'admin_actions', [
                'buttons' => [
                    [
                        'label' => 'ekyna_core.button.edit',
                        'icon' => 'pencil',
                        'class' => 'warning',
                        'route_name' => 'ekyna_agenda_event_admin_edit',
                        'route_parameters_map' => [
                            'eventId' => 'id'
                        ],
                        'permission' => 'edit',
                    ],
                    [
                        'label' => 'ekyna_core.button.remove',
                        'icon' => 'trash',
                        'class' => 'danger',
                        'route_name' => 'ekyna_agenda_event_admin_remove',
                        'route_parameters_map' => [
                            'eventId' => 'id'
                        ],
                        'permission' => 'delete',
                    ],
                ],
            ])
            /*->addFilter('title', 'text', array(
                'label' => 'ekyna_core.field.title',
            ))*/
            ->addFilter('startDate', 'datetime', [
                'label' => 'ekyna_core.field.start_date',
            ])
            ->addFilter('endDate', 'datetime', [
                'label' => 'ekyna_core.field.end_date',
            ])
            ->addFilter('enabled', 'boolean', [
                'label' => 'ekyna_core.field.enabled',
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ekyna_agenda_event';
    }
}
