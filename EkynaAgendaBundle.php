<?php

namespace Ekyna\Bundle\AgendaBundle;

use Ekyna\Bundle\AgendaBundle\DependencyInjection\Compiler\AdminMenuPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class EkynaAgendaBundle
 * @package Ekyna\Bundle\AgendaBundle
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class EkynaAgendaBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new AdminMenuPass());
    }
}
