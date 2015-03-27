<?php

namespace Ekyna\Bundle\AgendaBundle\DependencyInjection;

use Ekyna\Bundle\AdminBundle\DependencyInjection\AbstractExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader;

/**
 * Class EkynaAgendaExtension
 * @package Ekyna\Bundle\AgendaBundle\DependencyInjection
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class EkynaAgendaExtension extends AbstractExtension implements PrependExtensionInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $config = $this->configure($configs, 'ekyna_agenda', new Configuration(), $container);

        $container->setParameter('ekyna_agenda.admin_config', $config['admin']);
    }

    /**
     * {@inheritDoc}
     */
    public function prepend(ContainerBuilder $container)
    {
        $bundles = $container->getParameter('kernel.bundles');

        if (array_key_exists('AsseticBundle', $bundles)) {
            $this->configureAsseticBundle($container);
        }
    }

    /**
     * Configures the assetic bundle.
     *
     * @param ContainerBuilder $container
     */
    protected function configureAsseticBundle(ContainerBuilder $container)
    {
        $container->prependExtensionConfig('assetic', array(
            'bundles' => array('EkynaAgendaBundle')
        ));
    }
}
