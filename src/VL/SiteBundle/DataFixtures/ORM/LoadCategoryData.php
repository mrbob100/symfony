<?php
/**
 * Created by PhpStorm.
 * User: Vladymir
 * Date: 29.12.2015
 * Time: 20:26
 */
# src/VL/JSiteBundle/DataFixtures/ORM/LoadCategoryData.php

namespace VL\SiteBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use VL\SiteBundle\Entity\Category;

class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $articles = new Category();
        $articles->setName('Статьи');
        $articles->setSlug('first');
        $video = new Category();
        $video->setName('Видеоуроки');
        $video->setSlug('second');
        $modeling = new Category();
        $modeling->setName('Моделирование');
        $modeling->setSlug('third');
        $administrator = new Category();
        $administrator->setName('Администрирование');
        $administrator->setSlug('fourth');
        $aboutAuthor=new Category();
        $aboutAuthor->setName('Об авторе');
        $aboutAuthor->setSlug('fifth');
        $glavnaya=new Category('sixth');
        $glavnaya->setName('Главная');
        $glavnaya->setSlug('sixth');

        $em->persist($articles);
        $em->persist($video);
        $em->persist($modeling);
        $em->persist($administrator);
        $em->persist($aboutAuthor);
        $em->persist($glavnaya);

        $em->flush();
        $this->addReference('category-articles', $articles);
        $this->addReference('category-video', $video);
        $this->addReference('category-modeling', $modeling);
        $this->addReference('category-administrator', $administrator);
        $this->addReference('category-aboutauthor', $aboutAuthor);
        $this->addReference('category-glavnaya', $glavnaya);
    }

    public function getOrder()
    {
        return 1;
    }
}
