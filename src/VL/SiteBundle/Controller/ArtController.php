<?php

namespace VL\SiteBundle\Controller;

use Monolog\Handler\ElasticSearchHandlerTest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;
use VL\SiteBundle\Entity\Art;
use VL\SiteBundle\Form\ArtType;
use VL\SiteBundle\Entity\Category;
use VL\SiteBundle\Entity\User;
use VL\SiteBundle\Entity\Lesson;
use Ulogin\AuthBundle\Entity;

/**
 * Art controller.
 *
 */


class ArtController extends Controller
{


    /**
     * Lists all Art entities.
     *
     */
    public function indexAction($slug, $page)
    {
        //$em = $this->getDoctrine()->getManager();


        

    //GLOBAL $dser;
     //   $dser=new Category();

//$house=array('Иванов','Петров','Сидоров','Окунев');
//       $str=implode("!",$house);
 //       $arr=explode("!",$str);
  //      $ss=mb_substr($str,0,4,'utf-8');

        //  установка сессионной переменной
        //$this->get('minuet');

         if (!$this->get('session')->has('session_var'))
         {
             $this->get('session')->remove('session_var');   ////удаление сессионной переменной
         }

      //  $categories =$this->get('minuet');
        // $categories = $em->getRepository('VLSiteBundle:Category')->getWithArts();
        //$sas=Art::$newart;
		// cохранение сессионной переменной
         //   $this->get('session')->set('session_var',serialize($categories ));
       // }else
        // {
              // // изъятие сессионной переменной
        //    $categories = unserialize($this->get('session')->get('session_var'));
        // }
      //  $sas=Art::$newart;

     //  $this->get('session')->remove('session_var');   ////удаление сессионной переменной
    /*    foreach($categories as $category)
        {
            if(($category->getId())==$slug)
            {
                $category->setActiveArts($em->getRepository('VLSiteBundle:Art')->getActiveArts(
                    $category->getId(),
                    $this->container->getParameter('max_arts_on_homepage')));
                //определение общеего количества статей на сайте опубликованных
                $activeArtsCount = $em->getRepository('VLSiteBundle:Art')->countActiveArts($category->getId());
                $totalArts= $activeArtsCount;

                if ($activeArtsCount >= $this->container->getParameter('max_arts_on_homepage'))
                {
                    $activeArtsCount -= $this->container->getParameter('max_arts_on_homepage');
                  $category->setMoreArts($activeArtsCount);
                    $sa= $category->getMoreArts();
                }
                $artsPerPage  = $this->container->getParameter('max_arts_on_homepage');
                $lastPage     = ceil($totalArts / $artsPerPage);
                $previousPage = $page > 1 ? $page - 1 : 1;
                $nextPage     = $page < $lastPage ? $page + 1 : $lastPage;
                $glavnaya=$em->getRepository('VLSiteBundle:Art')->getActiveArts($category->getId(),$artsPerPage,($page - 1) * $artsPerPage);
                break;
            }

        }

         $art=$glavnaya[0]->getType();
*/
       // if(($glavnaya[0]->getType())=="Cтатьи")
        $searcher=$this->get('searcher');
        $spo=$searcher->searchCategory($slug, $page);
        if($spo->art==='Статьи')
        {

            $newArticles=$spo->em->getRepository('VLSiteBundle:Art')->getActiveArts(1,$spo->artsPerPage);
            return $this->render('VLSiteBundle:Art:show.html.twig', array(
                'categories'=>$spo->categories,
                'glavnaya'=>$spo->glavnaya,
                'lastPage'     => $spo->lastPage,
                'previousPage' => $spo->previousPage,
                'currentPage'  => $page,
                'nextPage'     => $spo->nextPage,
                'totalArts'    => $spo->totalArts,
                'newArticles'=>$newArticles,
                'artsPerPage' => $spo->artsPerPage, 'slugish'=>$slug));
        }

        if($spo->art==='Видеоуроки')
        {

            return $this->render('VLSiteBundle:Art:video.html.twig', array(
                'categories'=>$spo->categories,
            ));
        }

        $newArticles=$spo->em->getRepository('VLSiteBundle:Art')->getActiveArts(1,$spo->artsPerPage);
        return $this->render('VLSiteBundle:Art:index.html.twig', array(
            'categories'=>$spo->categories,
            'glavnaya'=>$spo->glavnaya,
            'newArticles'=>$newArticles,
        ));
    }




    /**
     * Creates a new Art entity.
     *
     */
    public function createAction(Request $request, $slug)
    {
            $em = $this->getDoctrine()->getManager();
              $categories = $em->getRepository('VLSiteBundle:Category')->getWithArts();


            $entity1 = new Comment();
        $recaptcha = $this->createForm($this->get('form.type.recaptcha'));

        $entity=$em->getRepository('VLSiteBundle:Art')->getActiveArt($slug);

        $form = $this->createCreateForm($entity1);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $em->persist($entity1);
            $em->flush();

            return $this->redirect($this->generateUrl('vl_art_show', array('id' => $entity1->getId(),
                "categories"=>$categories, "entity"=>$entity,)));
        }

        return $this->render('VLSiteBundle:Art:new.html.twig', array(
            'entity1' => $entity1,
            'form'   => $form->createView(),
            'recaptcha' => $recaptcha->createView(),
            "categories"=>$categories, "entity"=>$entity,
        ));
    }

    /**
     * Creates a form to create a Art entity.
     *
     * @param Art $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */


    /**
     * Finds and displays a Art entity.
     *
     */
 /*   public function showAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('VLSiteBundle:Category')->getWithArts();
        $sas=Art::$newart;
        foreach($categories as $category)
        {
            if(($category->getId())==$slug)
            {
                $category->setActiveArts($em->getRepository('VLSiteBundle:Art')->getActiveArts(
                    $category->getId(),
                    $this->container->getParameter('max_arts_on_homepage')));
                $activeArtsCount = $em->getRepository('VLSiteBundle:Art')->countActiveArts($category->getId());
                if ($activeArtsCount >= $this->container->getParameter('max_arts_on_homepage'))
                {
                    $activeArtsCount -= $this->container->getParameter('max_arts_on_homepage');
                    $category->setMoreArts($activeArtsCount);
                }
                $entities=$category->getActiveArts();
            }

        }


        return $this->render('VLSiteBundle:Art :show.html.twig', array(
            'categories'=>$categories,
            'glavnaya'=>$entities,
        ));
    }
*/

//__________________________________________________________________________________________
    public function showAction($slug, $slug1) // вывод статей
    //public function showAction($slug) // вывод статей

{
       $em = $this->getDoctrine()->getManager();

       $categories = $em->getRepository('VLSiteBundle:Category')->getWithArts();

        //$categories =$this->get('minuet');
       if($slug1=='yes') {
           return $this->forward('VLSiteBundle:Art:create', array('slug1'=>$slug1,));
        }
    $artsPerPage  = Category::MAX_ARTS_ON_HOMEPAGE;
      $entity=$em->getRepository('VLSiteBundle:Art')->getActiveArt($slug);
    $article=Category::CATEGORY_CTATYA_NUMBER;
    $newArticles=$em->getRepository('VLSiteBundle:Art')->getActiveArts($article,$artsPerPage);
       // $this->generateUrl('vl_art_show', array('id' =>  $glavnaya->getId()));
        return $this->render("VLSiteBundle:Art:article.html.twig", array(
            'entity'=>$entity,
            'newArticles'=>$newArticles,
            'categories'=>$categories,));
    }
    //_____________________________________________________________________________________________





    //_____________________________________________________________________________________________

//  контроллер авторизации как обычной, так и через социальные сети

    public function loginAction()
    {

        $em = $this->getDoctrine()->getManager();
        $access = FALSE;
        $categories = $em->getRepository('VLSiteBundle:Category')->getWithArts();
        
        $request = $this->container->get('request_stack')->getCurrentRequest();
        $cookies = $request->cookies->all();
        if(isset($cookies['WebEngineerRestrictedArea']))
        {
            $data_array = explode("!",$cookies['WebEngineerRestrictedArea']);
            if (preg_match("/^[a-zA-Z0-9,:+]{3,30}$/", $data_array[0]))
            {
                $user = $em->getRepository('VLSiteBundle:User')->getUsers($data_array[0],$data_array[3]);

                if(!$user) throw $this->createNotFoundException('Нет такого пользователя.');

                    $cookies_hash =$data_array[1];
                  $secr=$user[0]->getSalt();
                    $evaluate_hash = md5($secr."!".$_SERVER['REMOTE_ADDR']);
                    if ($cookies_hash == $evaluate_hash) {
                        $access = TRUE;
      // установка сессионной переменной
                        // перевод объекта в строку
                        $user8=array('username'=>$user[0]->getUsername(),'first_name'=>$user[0]->getFirstName(),
                            'last_name'=>$user[0]->getLastName(), 'numContract'=>$user[0]->getNumContract(),
                            'email'=>$user[0]->getEmail(),'salt'=>$user[0]->getSalt(),'id'=>$user[0]->getId() );
                        $this->get('session')->remove('session_var');   ////удаление сессионной переменной
                       $this->get('session')->set('session_var',serialize($user8['id'] ));
                                                         }

            } else {
                $access = FALSE;
                   }
        }

        $artsPerPage  = Category::MAX_ARTS_ON_HOMEPAGE;
        $article=Category::CATEGORY_CTATYA_NUMBER;
        $newArticles=$em->getRepository('VLSiteBundle:Art')->getActiveArts($article,$artsPerPage);

        if(!$access)
        {
   //____________________________________________________________________________________________
            // если регистрация из социальных сетей минуем регистрацию
            if(isset($_POST['token'])) return $this->forward('VLSiteBundle:Art:cook');
//__________________________________________________________________________________________________
            // переход на регистрацию



            return $this->render("VLSiteBundle:Art:login.html.twig", array(
                'newArticles'=>$newArticles,
                'categories' => $categories,));
        }
// вызов заполнения бланка заказа
            $entities=$em->getRepository('VLSiteBundle:Lesson')->findAll();

            return $this->render('VLSiteBundle:User:show.html.twig', array(
                'newArticles'=>$newArticles,
                'categories'=>$categories,
                'entities'=>$entities,
            ));

    }
    //_____________________________________________________________________________________________

    public function cookAction()
    {
        // становка куков, обновление записей пользователя
        $em = $this->getDoctrine()->getManager();
        $access = FALSE;
        $slug1='form'; // регистрация по введенным данным с экрана
        $result=$this->proverca(); //проверка на валидность регистрационных данных
        if(($result)or(isset($_POST['token'])))
        {

            $priznak=false;
            if(isset($_POST['token'])) //если регистрация через соц. сети
            {
                $s = file_get_contents('http://ulogin.ru/token.php?token=' . $_POST['token'] .
                    '&host=' . $_SERVER['HTTP_HOST']);
                $code = json_decode($s, true);
                $sertif=array('salt'=>'false', 'numContract'=>'false');
                $user=array_merge($code,$sertif );
                $login=$user['network'].":".$user['uid'];
                $user['username']=$login;
                 $email=$user['email'];
            } else {
              //  $login=array('username'=>$_POST['login']);
                $login=$_POST['identity']; $email=$_POST['email'];
                $user=array('username'=>$_POST['identity'],'first_name'=>$_POST['first_name'], 'last_name'=>$_POST['last_name'],
                    'email'=>$_POST['email'],'salt'=>'false','numContract'=>'false','id'=>'NULL' );
            }

            $user1 = $em->getRepository('VLSiteBundle:User')->getUsers($login,$email);
          //  $user = $em->getRepository('VLSiteBundle:User')->findBy(array('username'=>$_POST['login']));
            if (!$user1) {

                   $user2= $em->getRepository('VLSiteBundle:User')->setUser($user, $em);
                    $user=$user2;


            } else {

               // $user1[0]->setSekretkey($user['sekretkey']);
              $user2=$em->getRepository('VLSiteBundle:User')->userUpdate($user1, $em);
              $user['salt']=$user2[0]->getSalt();  $user['id']=$user2[0]->getId();
                   }


            $em->getRepository('VLSiteBundle:User')->setCooky($user);
            if ($this->get('session')->has('session_var'))
            {
                $user['id'] = unserialize($this->get('session')->get('session_var'));
            } else
            $this->get('session')->set('session_var',serialize( $user['id']));

            return $this->forward('VLSiteBundle:User:zakaz');
        }

        $slug=Category::HOME_PAGE;
        return $this->forward('VLSiteBundle:Art:index', array('slug'=>$slug));
    }


    public function proverca( )
    {
        $bob=false;
      //  if(isset($_POST[$slug1])) {
            if (!empty($_POST['email']) && !empty($_POST['identity']) && !empty($_POST['g-recaptcha-response']))
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
      //  }
        return $bob;
    }

    /**
     *
     * Displays a form to edit an existing Art entity.
     *
     */

    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VLSiteBundle:Art')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Art entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('VLSiteBundle:Art:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Art entity.
    *
    * @param Art $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Art $entity)
    {
        $form = $this->createForm(new ArtType(), $entity, array(
            'action' => $this->generateUrl('vl_art_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Art entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VLSiteBundle:Art')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Art entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('vl_art_edit', array('id' => $id)));
        }

        return $this->render('VLSiteBundle:Art:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Art entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('VLSiteBundle:Art')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Art entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('vl_art'));
    }

    /**
     * Creates a form to delete a Art entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('vl_art_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }



}
