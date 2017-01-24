<?php

namespace VL\SiteBundle\Controller;

use Monolog\Handler\ElasticSearchHandlerTest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;
use VL\SiteBundle\Entity\Art;
use VL\SiteBundle\Entity\Comment;
use VL\SiteBundle\Form\CommentType;

use VL\SiteBundle\Entity\Category;
use VL\SiteBundle\Entity\User;
use VL\SiteBundle\Entity\Lesson;

/**
 * Art controller.
 *
 */


class CommentController extends Controller
{
       /**
     * Lists all Comment entities.
     *
     */
    public function indexAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
     //   $request = $this->container->get('request_stack')->getCurrentRequest();
         $categories = $em->getRepository('VLSiteBundle:Category')->getWithArts();
         $glavnaya=$em->getRepository('VLSiteBundle:Art')->getActiveArt($slug);
         $entity = new Comment();
        //$recaptcha = $this->createForm($this->get('form.type.recaptcha'));

       // $form = $this->createCreateForm($entity,$slug);
       // $form = $this->createForm(new CommentType(), $entity);
      //  $form->handleRequest($request);
        $slug1='submit_reg';
        $result=$this->proverca( $slug1); //проверка на валидность регистрационных данных
        $artsPerPage  = Category::MAX_ARTS_ON_HOMEPAGE;
        $article=Category::CATEGORY_CTATYA_NUMBER;
        $newArticles=$em->getRepository('VLSiteBundle:Art')->getActiveArts($article,$artsPerPage);
        if($result)
        {
             $res=$em->getRepository('VLSiteBundle:Comment')->getComments($_POST['login'],$_POST['email'], $slug);
            if($res)
              {
                echo('Вы уже оставили свои комментарии к этой статье');

              } else
                   {    // помещение регистрационных данных пользователя в БД
                      $entity->setCreatedAtValue(); $entity->setSiteId($slug);  $entity->setArt($glavnaya);
                       $entity->setName($_POST['login']); $entity->setEmail($_POST['email']);
                       $entity->setContent($_POST['data1']);
                      $em->persist($entity);
                      $em->flush();
                   }
         //  return $this->redirect($this->generateUrl('vl_site_display', array('slug1' => $entity->getName(),
          //     "slug"=>$slug,)));
            return $this->redirect($this->generateUrl('vl_site_display', array( "slug"=>$slug,)));

        }

        return $this->render('VLSiteBundle:Comment:new100.html.twig', array(
            'entity' => $entity,
           // 'form'   => $form->createView(),
          //  'recaptcha' => $recaptcha->createView(),
            'newArticles'=>$newArticles,
            "categories"=>$categories, "glavnaya"=>$glavnaya,));
    }

    private function createCreateForm(Comment $entity, $slug)
    {
        $form = $this->createForm(new CommentType(), $entity, array(
            'action' => $this->generateUrl('vl_site_index', array('slug'=>$slug)),
            'method' => 'POST',));

      //  $form->add('submit', 'submit', array('label' => 'Ввести','attr' => array('class' => 'hgot2')));

        return $form;
    }

    /**
     * Displays a form to create a new Art entity.
     *
     */
    public function newAction()
    {
        $entity = new Comment();
        $form   = $this->createCreateForm($entity);

        return $this->render('VLSiteBundle:Comment:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
//_______________________________________________________________________________________________________________________________
//        Вывод комментариев к статьям
//_______________________________________________________________________________________________________________________________
    public function displayAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
       // $request = $this->container->get('request_stack')->getCurrentRequest();
        $categories = $em->getRepository('VLSiteBundle:Category')->getWithArts();
        $glavnaya=$em->getRepository('VLSiteBundle:Art')->getActiveArt($slug);
       // $entity = new Comment();
        $commentCount=$em->getRepository('VLSiteBundle:Comment')->countCommentArt($glavnaya->getId());
        if($commentCount>5)
         {
             $delItem=false;
             $commentCount-=5;
             $delItem=$em->getRepository('VLSiteBundle:Comment')->deleteCommentArt($slug);
             if($delItem)
              {
                 for($i=0;$i<$commentCount; $i++)  $em->remove($delItem[$i]);
                 $em->flush();
              }
         }
        $allComments=$em->getRepository('VLSiteBundle:Comment')->getAllComments($slug);

        $artsPerPage  = Category::MAX_ARTS_ON_HOMEPAGE;
        $article=Category::CATEGORY_CTATYA_NUMBER;
        $newArticles=$em->getRepository('VLSiteBundle:Art')->getActiveArts($article,$artsPerPage);

        return $this->render('VLSiteBundle:Comment:newall.html.twig', array(
           // 'entity' => $entity,
            'newArticles'=>$newArticles,
            'allComments'=>$allComments,
            "categories"=>$categories, "glavnaya"=>$glavnaya,));

    }

//_________________________________________________________________________________________________________________________________
//      Функция проверки капчи
//_________________________________________________________________________________________________________________________________
    public function proverca( $slug1)
    {
        $bob=false;
       if(isset($_POST[$slug1])) {
            if (!empty($_POST['email']) && !empty($_POST['login']) && !empty($_POST['data1'])&& !empty($_POST['g-recaptcha-response']))
            {
                $recaptcha = $_POST['g-recaptcha-response'];
                $google_url = "https://www.google.com/recaptcha/api/siteverify";
                $secret = '6LfmECUTAAAAAC4nCEPwamNbaJqDSH0gh29ApzbY';
                $ip = $_SERVER['REMOTE_ADDR'];
                $url = $google_url . "?secret=" . $secret . "&response=" . $recaptcha . "&remoteip=" . $ip;
                // $context  = stream_context_create($url);
                //  $result = file_get_contents( $context);
                $result = json_decode(file_get_contents( $url));

                if($result->success==true) $bob=true;

            }
        }
        return $bob;
    }


}

















