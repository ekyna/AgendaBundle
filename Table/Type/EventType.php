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
    public function buildTable(TableBuilderInterface $builder, array $options = array())
    {
        $builder
            ->addColumn('name', 'anchor', array(
                'label' => 'ekyna_core.field.name',
                'sortable' => true,
                'route_name' => 'ekyna_agenda_event_admin_show',
                'route_parameters_map' => array(
                    'eventId' => 'id'
                ),
            ))
            /*->addColumn('category', 'anchor', array(
                'label' => 'ekyna_core.field.category',
                'property_path' => 'category.name',
                'sortable' => false,
                'route_name' => 'ekyna_agenda_category_admin_show',
                'route_parameters_map' => array('categoryId' => 'category.id'),
            ))*/
            ->addColumn('startDate', 'datetime', array(
                'label' => 'ekyna_core.field.start_date',
                'sortable' => true,
            ))
            ->addColumn('endDate', 'datetime', array(
                'label' => 'ekyna_core.field.end_date',
                'sortable' => true,
            ))
            ->addColumn('enabled', 'boolean', array(
                'label' => 'ekyna_core.field.enabled',
                'sortable' => true,
                'route_name' => 'ekyna_agenda_event_admin_toggle',
                'route_parameters_map' => array(
                    'eventId' => 'id',
                ),
            ))
            ->addColumn('actions', 'admin_actions', array(
                'buttons' => array(
                    array(
                        'label' => 'ekyna_core.button.edit',
                        'icon' => 'pencil',
                        'class' => 'warning',
                        'route_name' => 'ekyna_agenda_event_admin_edit',
                        'route_parameters_map' => array(
                            'eventId' => 'id'
                        ),
                        'permission' => 'edit',
                    ),
                    array(
                        'label' => 'ekyna_core.button.remove',
                        'icon' => 'trash',
                        'class' => 'danger',
                        'route_name' => 'ekyna_agenda_event_admin_remove',
                        'route_parameters_map' => array(
                            'eventId' => 'id'
                        ),
                        'permission' => 'delete',
                    ),
                ),
            ))
            ->addFilter('name', 'text', array(
                'label' => 'ekyna_core.field.name',
            ))
            ->addFilter('startDate', 'datetime', array(
                'label' => 'ekyna_core.field.start_date',
            ))
            ->addFilter('endDate', 'datetime', array(
                'label' => 'ekyna_core.field.end_date',
            ))
            ->addFilter('enabled', 'boolean', array(
                'label' => 'ekyna_core.field.enabled',
            ))
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
