<?php
/**
 * Created by PhpStorm.
 * User: Vladymir
 * Date: 29.12.2015
 * Time: 20:26
 */
# src/VL/SiteBundle/DataFixtures/ORM/LoadArtData.php

namespace VL\SiteBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use VL\SiteBundle\Entity\Art;

class LoadArtData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $jobFullTime = new Art();
        $jobFullTime->setCategory($em->merge($this->getReference('category-articles')));
        $jobFullTime->setType('Статьи');
        $jobFullTime->setAuthor('В.М.Похвалит');
        $jobFullTime->setNickName('company_logo.png');
        $jobFullTime->setShortCont('Описание статьи.Теперь, когда все установлено, в JoboardBundle нужно создать новую директорию с именем DataFixtures/ORM, там мы создадим несколько новых классов для загрузки начальных данных LoadCategoryData.php и LoadJobData.php (файлы должны называться также как и классы):');
        $jobFullTime->setContent('Москва. Во время выполнения этой команды, вам нужно будет указать некоторые параметры, можете просто выбрать значения по умолчанию (которые в квадратных скобках). Для просмотра списка вакансий в браузере, мы должны импортировать новые маршруты, которые были созданы в src/App/JoboardBundle/Resources/config/routing/job.yml в файл маршрутизации основного бандла, добавьте следующий код в основной файл маршрутизации src/App/JoboardBundle/Resources/config/routing.yml:');
        $jobFullTime->setIsPublic(true);
        $jobFullTime->setToken('job_example_com');
        $jobFullTime->setCreatedAt(new \DateTime('+30 days'));
        $jobPartTime = new Art();
        $jobPartTime->setCategory($em->merge($this->getReference('category-video')));
        $jobPartTime->setType('Видеоуроки');
        $jobPartTime->setAuthor('ООО Дизайн Компания');
        $jobPartTime->setNickName('Stranger');
        $jobPartTime->setShortCont('Коалиция во главе с США уничтожила 90% нефтяных объектов группировки «Исламское государство» на территории Сирии и Ирака.');
        $jobPartTime->setContent('Коалиция во главе с США уничтожила 90% нефтяных объектов группировки «Исламское государство» на территории Сирии и Ирака.

Об этом заявил пресс-секретарь международной коалиции Стив Уоррен, сообщает Газета.ru со ссылкой на Alsumaria.

Он отметил, что группировка потеряла 40% своей территории из-за авиаударов.

Кроме того, Уоррен заявил, что у коалиции есть план по освобождению Мосула.

Ранее сообщалось, что резолюция Совета Безопасности ООН по мирному урегулированию конфликта в Сирии была принята единогласно. В документе отмечается, что в январе должны состояться межсирийские переговоры, в течение полутора лет — выборы.');

        $jobPartTime->setIsPublic(true);
        $jobPartTime->setToken('designer_resume@example.com');
        $jobPartTime->setCreatedAt(new \DateTime('+30 days'));
        $jobExpired = new Art();
        $jobExpired->setCategory($em->merge($this->getReference('category-modeling')));
        $jobExpired->setType('Моделирование');
        $jobExpired->setAuthor('DevAcademy');
        $jobExpired->setNickName('Stranger');
        $jobExpired->setShortCont('Зокрема, йдеться про такі структури, як антикорупційна прокуратура. Про це в понеділок, 21 грудня, в ефірі "5 каналу" під час марафону "Україна понад усе" повідомив виконавчий директор центру економічної стратегії Гліб Вишлінський.');
        $jobExpired->setContent('Зокрема, йдеться про такі структури, як антикорупційна прокуратура. Про це в понеділок, 21 грудня, в ефірі "5 каналу" під час марафону "Україна понад усе" повідомив виконавчий директор центру економічної стратегії Гліб Вишлінський.

"Багато хто не знає і каже, що МВФ ніяк не допомагає боротися із корупцією, але насправді вимоги щодо формування антикорупційних інституцій були одними з вимог поточної програми з Міжнародним валютним фондом", - зазначив він. ');

        $jobExpired->setIsPublic(true);
        $jobExpired->setToken('job_expired');
        $jobExpired->setCreatedAt(new \DateTime('2015-10-01'));


        $em->persist($jobExpired);
        $em->persist($jobFullTime);
        $em->persist($jobPartTime);


        $em->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
