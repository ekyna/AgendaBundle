<?php

namespace Ekyna\Bundle\AgendaBundle\Form\Type;

use Ekyna\Bundle\AdminBundle\Form\Type\ResourceFormType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class EventType
 * @package Ekyna\Bundle\AgendaBundle\Form\Type
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class EventType extends ResourceFormType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                'label' => 'ekyna_core.field.name',
            ))
            ->add('title', 'text', array(
                'label' => 'ekyna_core.field.title',
            ))
            ->add('category', 'ekyna_resource', array(
                'label' => 'ekyna_core.field.category',
                'class' => 'Ekyna\Bundle\AgendaBundle\Entity\Category',
                'property' => 'name',
                'allow_new' => $options['admin_mode'],
                'allow_list' => $options['admin_mode'],
                'empty_value' => 'ekyna_core.field.category',
                'attr' => array(
                    'placeholder' => 'ekyna_core.field.category',
                ),
            ))
            ->add('startDate', 'datetime', array(
                'label' => 'ekyna_core.field.start_date',
            ))
            ->add('endDate', 'datetime', array(
                'label' => 'ekyna_core.field.end_date',
            ))
            ->add('private', 'checkbox', array(
                'label' => 'ekyna_agenda.event.field.private',
                'required' => false,
                'attr' => array(
                    'align_with_widget' => true,
                )
            ))
            ->add('enabled', 'checkbox', array(
                'label' => 'ekyna_core.field.enabled',
                'required' => false,
                'attr' => array(
                    'align_with_widget' => true,
                )
            ))
            ->add('seo', 'ekyna_cms_seo')
        ;
    }

    /**
     * {@inheritdoc}
     */
    /*public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
        ));
    }*/

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ekyna_agenda_event';
    }
}
