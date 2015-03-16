<?php

namespace Ekyna\Bundle\AgendaBundle\Install;

use Ekyna\Bundle\AgendaBundle\Entity\Category;
use Ekyna\Bundle\InstallBundle\Install\OrderedInstallerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class AgendaInstaller
 * @package Ekyna\Bundle\AgendaBundle\Install
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class AgendaInstaller implements OrderedInstallerInterface
{
    private $defaultCategories = array(
        'Publique' => array('#428bca'),
        'Privée'   => array('#d9534f'),
    );

    /**
     * {@inheritdoc}
     */
    public function install(ContainerInterface $container, Command $command, InputInterface $input, OutputInterface $output)
    {
        /*$output->writeln('<info>[Agenda] Creating default categories:</info>');
        $this->createDefaultCategories($container, $output);
        $output->writeln('');*/
    }

    /**
     * Creates the default recipient list.
     *
     * @param ContainerInterface $container
     * @param OutputInterface $output
     */
    private function createDefaultCategories(ContainerInterface $container, OutputInterface $output)
    {
        $repository = $container->get('ekyna_agenda.category.repository');

        foreach ($this->defaultCategories as $name => $config) {
            $output->write(sprintf(
                '- <comment>%s</comment> %s ',
                $name,
                str_pad('.', 44 - mb_strlen($name), '.', STR_PAD_LEFT)
            ));

            if (null === $category = $repository->findOneBy(['name' => $name])) {
                $category = new Category();
                $category
                    ->setName($name)
                    ->setColor($config[0])
                ;

                $em = $container->get('ekyna_agenda.category.manager');
                $em->persist($category);
                $em->flush();

                $output->writeln('done.');
            } else {
                $output->writeln('already exists.');
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 99;
    }
}