<?php
/**
 * Created by PhpStorm.
 * User: Vladymir
 * Date: 10.03.2016
 * Time: 9:38
 */
# src/VL/JSiteBundle/DataFixtures/ORM/LoadLessonData.php
namespace VL\SiteBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use VL\SiteBundle\Entity\Lesson;

class LoadLessonData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $lesson=new Lesson();
        $lesson->setName('Урок 1');
        $lesson->setDescription("Видео уроки финансового анализа и корпоративного менеджмента, объяснение баланса предприятия, графическое представление баланса, объяснения форм бухгалтерской отчетности. Рассмотрены зарубежные аналоги. Основные различия международных стандартов и их причины, различия общих принципов учета.");
        $lesson->setPrice(250);

        $lesson1=new Lesson();
        $lesson1->setName('Урок 2');
        $lesson1->setDescription('Вертикальный и горизонтальный анализы баланса и отчета о финансовых результатах предприятия. Расчеты проведены в MATLAB, строится сценарий выполнения операций. Определяется ликвидность баланса предприятия  и его финансовая устойчивость');
        $lesson1->setPrice(350);

        $lesson2=new Lesson();
        $lesson2->setName('Урок 3');
        $lesson2->setDescription('В видеоуроке описаны приемы оценки стоимости капитала, принципы дисконтирования, определение средневзвешенной стоимости капитала');
        $lesson2->setPrice(100);

        $lesson3=new Lesson();
        $lesson3->setName('Урок 4');
        $lesson3->setDescription('В данном видеоуроке даны определения чистых денежных потоков NPV и внутренней нормы рентабельности IRR, дано определение точки безубыточности, приведен пример оценки проекта создания таксомоторного парка с использованием пакета Project expert.');
        $lesson3->setPrice(100);

        $lesson4=new Lesson();
        $lesson4->setName('Урок 5');
        $lesson4->setDescription('В этом уроке  изложены основы эконометрии, получение основных характеристик нормального закона распределение с помощью Матлаб, регрессионный анализ, получение прогнозных значений случайных величин, прогноз банкротства предприятия');
        $lesson4->setPrice(100);

        $lesson5=new Lesson();
        $lesson5->setName('Урок 6');
        $lesson5->setDescription('В уроке рассмотрены вопросы  финансового планирования (бюджетного), производственного планирования с использованием методов статистического моделирования, линейного программирования, имитационного моделирования, проведения SWOT анализа компании.');
        $lesson5->setPrice(100);

        $lesson6=new Lesson();
        $lesson6->setName('Урок 7');
        $lesson6->setDescription('В уроке рассмотрены вопросы работы с акциями предприятий, поиск акций по критериям Бенджемина Грэма и Джоуэла Гринблатта. Оценка отобранных акций. Создание инвестиционного портфеля.');
        $lesson6->setPrice(100);


        $em->persist($lesson);
        $em->persist($lesson1);
        $em->persist($lesson2);
        $em->persist($lesson3);
        $em->persist($lesson4);
        $em->persist($lesson5);
        $em->persist($lesson6);

        $em->flush();

    }

    public function getOrder()
    {
        return 3;
    }

}