<?php
namespace VL\SiteBundle\Controller;

use Monolog\Handler\ElasticSearchHandlerTest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;
use FOS\UserBundle\Mailer\Mailer;
use VL\SiteBundle\Entity\Art;
use VL\SiteBundle\Form\ArtType;
use VL\SiteBundle\Entity\Category;
use VL\SiteBundle\Entity\User;
use VL\SiteBundle\Entity\Lesson;

/**
 * Art controller.
 *
 */


class UserController extends Controller
{

    public function zakazAction()
    {
        $em = $this->getDoctrine()->getManager();
        if (!$this->get('session')->has('session_var'))
        {
            $this->get('session')->remove('session_var');   ////удаление сессионной переменной
        }
        $categories = $em->getRepository('VLSiteBundle:Category')->getWithArts();
        $entities=$em->getRepository('VLSiteBundle:Lesson')->findAll();
        $artsPerPage  = Category::MAX_ARTS_ON_HOMEPAGE;
        $newArticles=$em->getRepository('VLSiteBundle:Art')->getActiveArts(1,$artsPerPage);
        return $this->render('VLSiteBundle:User:show.html.twig', array(
            'categories'=>$categories,
            'entities'=>$entities,
            'newArticles'=>$newArticles,
            ));

    }

    public function buyAction()
    {
        if (isset($_POST['submit'])and isset($_POST['artext']) )
        {
            $sum=0;
            $result=$_POST['artext'];
           $split=explode(',',$result);
            $keys=$values=array();
            for($i=0, $cnt=count($split); $i<$cnt; $i++)
            {
                if($i%2 == 0)
                {
                    $keys[]=$split[$i];
                } else { $values[]=$split[$i]; $sum = $sum + $split[$i];}
            }

            //$params=array_combine($keys,$values);


       //     return $this->forward('VLSiteBundle:Art:login');
//----------------------------- переход на контроллер - отправить мыло , квитанцию и т.д
            // должна быть отправка E-mail с выписанным счетом
            // здесь выход на вывод самого урока и его цены

            $em = $this->getDoctrine()->getManager();
            $access = FALSE;
            $categories = $em->getRepository('VLSiteBundle:Category')->getWithArts();
            $entity=$em->getRepository('VLSiteBundle:Lesson')->findAll();
            // получение данных о пользователе
            $id=unserialize($this->get('session')->get('session_var'));
            $this->get('session')->remove('session_var');   ////удаление сессионной переменной
            // $em->getRepository('VLSiteBundle:User')->setCooky($user, $slug1,$entity->getPrice());
            // $this->generateUrl('vl_art_show', array('id' =>  $glavnaya->getId()));
            $user=$em->getRepository('VLSiteBundle:User')->userUpdateProduct($id,$keys,$em);

            $name=$user->getFirstName();
            $fio=$user->getLastName();
            $contract=$user->getNumContract();
            $lessons=implode(',',$keys);
            $space=" ";
            $mydate=new \DateTime();

            try {
                $message = \Swift_Message::newInstance()
                    ->setSubject('Отправка квитанции')
                    ->setFrom('no-reply@mysite.com')
                    ->setTo($user->getEmail())
                   ->setBody($this->render("VLSiteBundle:User:buy.html.twig", array(
                        'entity'=>$entity,
                        'categories'=>$categories,
                        'name'=>$name,
                        'fio'=>$fio,
                        'space'=>$space,
                        'mydate'=>$mydate,
                        'contract'=>$contract,
                        'lessons'=>$lessons,
                        'sum'=>$sum,)));

                // send an email to the affiliate

               $this->get('mailer')->send($message);


            }
            catch(\Exception $e) {
                $this->get('session')->setFlash('sonata_flash_error', $e->getMessage());
            }

            return $this->render("VLSiteBundle:User:buy1.html.twig", array(
                'entity'=>$entity,
                'categories'=>$categories,
                'name'=>$name,
                'fio'=>$fio,
                'space'=>$space,
                'mydate'=>$mydate,
                'contract'=>$contract,
                'lessons'=>$lessons,
                'sum'=>$sum,));



        }
        $slug=Category::HOME_PAGE;
        return $this->forward('VLSiteBundle:Art:index', array('slug'=>$slug));
    }



}




















