<?php
/**
 * Created by PhpStorm.
 * User: Vladymir
 * Date: 08.01.2016
 * Time: 11:06
 */
# src/VL/SiteBundle/Controller/ArtAdminController.php

namespace VL\SiteBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery as ProxyQueryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;


class ArtAdminController extends Controller
{
    public function batchActionExtend(ProxyQueryInterface $selectedModelQuery)
    {
        if ($this->admin->isGranted('EDIT') === false || $this->admin->isGranted('DELETE') === false) {
            throw new AccessDeniedException();
        }

        $modelManager = $this->admin->getModelManager();

        $selectedModels = $selectedModelQuery->execute();

        try {
            foreach ($selectedModels as $selectedModel) {
                $selectedModel->extend();
                $modelManager->update($selectedModel);
            }
        } catch (\Exception $e) {
            $this->get('session')->getFlashBag()->add('sonata_flash_error', $e->getMessage());

            return new RedirectResponse($this->admin->generateUrl('list',$this->admin->getFilterParameters()));
        }

        $this->get('session')->getFlashBag()->add('sonata_flash_success',  sprintf('Выбранные статьи продлены до %s.', date('m/d/Y', time() + 86400 * 30)));

        return new RedirectResponse($this->admin->generateUrl('list', $this->admin->getFilterParameters()));
    }


    public function batchActionDeleteNeverActivatedIsRelevant()
    {
        return true;
    }

    public function batchActionDeleteNeverActivated()
    {
        if ($this->admin->isGranted('EDIT') === false || $this->admin->isGranted('DELETE') === false) {
            throw new AccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();
        $nb = $em->getRepository('VLSiteBundle:Art')->cleanup(600);

        if ($nb) {
            $this->get('session')->getFlashBag()->add('sonata_flash_success', sprintf('%d просроченные статьи успешно удалены.', $nb));
        } else {
            $this->get('session')->getFlashBag()->add('sonata_flash_info', 'Нет статей для удаления.');
        }

        return new RedirectResponse($this->admin->generateUrl('list', $this->admin->getFilterParameters()));
    }

}