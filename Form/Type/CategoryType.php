<?php

namespace Ekyna\Bundle\AgendaBundle\Form\Type;

use Ekyna\Bundle\AdminBundle\Form\Type\ResourceFormType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class CategoryType
 * @package Ekyna\Bundle\AgendaBundle\Form\Type
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class CategoryType extends ResourceFormType
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
            ->add('backgroundColor', 'ekyna_core_color_picker', array(
                'label' => 'ekyna_agenda.category.field.background_color',
            ))
            ->add('textColor', 'ekyna_core_color_picker', array(
                'label' => 'ekyna_agenda.category.field.text_color',
            ))
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
        return 'ekyna_agenda_category';
    }
}
