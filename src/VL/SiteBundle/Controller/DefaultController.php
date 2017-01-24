<?php

namespace VL\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Security;
class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('VLSiteBundle:Default:index.html.twig', array('name' => $name));
    }

    public function loginAction($slug1)
    {
        $request = $this->get('request');
        $session = $this->get('session');

        if ($request->attributes->has(Security::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(Security::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(Security::AUTHENTICATION_ERROR);
            $session->remove(Security::AUTHENTICATION_ERROR);
        }

        return $this->render('VLSiteBundle:Default:login.html.twig', array(
            'last_username' => $session->get(Security::LAST_USERNAME),
            'error'         => $error,
        ));
    }
}
