<?php

namespace Ekyna\Bundle\AgendaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class EventTranslationType
 * @package Ekyna\Bundle\AgendaBundle\Form\Type
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class EventTranslationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', [
                'label' => 'ekyna_core.field.title',
            ])
            ->add('content', 'tinymce', [
                'label' => 'ekyna_core.field.content',
                'theme' => $options['admin_mode'] ? 'advanced' : 'front',
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults([
                'data_class' => 'Ekyna\Bundle\AgendaBundle\Entity\EventTranslation',
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ekyna_agenda_event_translation';
    }
}
