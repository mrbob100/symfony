<?php
/**
 * Created by PhpStorm.
 * User: Vladymir
 * Date: 29.01.2016
 * Time: 12:28
 */
namespace VL\SiteBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use VL\SiteBundle\Entity\User;

class SiteUsersCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('vl:site:users')
            ->setDescription('Добавление пользователей')
            ->addArgument('username', InputArgument::REQUIRED, 'Логин')
            ->addArgument('password', InputArgument::REQUIRED, 'Пароль')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $username = $input->getArgument('username');
        $password = $input->getArgument('password');

        $em = $this->getContainer()->get('doctrine')->getManager();

        $user = new User();
        $user->setUsername($username);
        $factory = $this->getContainer()->get('security.encoder_factory');
        $encoder = $factory->getEncoder($user);
        $encodedPassword = $encoder->encodePassword($password, $user->getSalt());
        $user->setPassword($encodedPassword);
        $em->persist($user);
        $em->flush();

        $output->writeln(sprintf('Добавлен пользователь %s с паролем %s', $username, $password));
    }
}