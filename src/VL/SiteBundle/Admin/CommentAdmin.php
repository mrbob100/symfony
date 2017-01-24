<?php
/**
 * Created by PhpStorm.
 * User: Vladymir
 * Date: 10.03.2016
 * Time: 10:30
 */
namespace VL\SiteBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;

class CommentAdmin extends Admin
{
    // установка сортировки по умолчанию
    protected $datagridValues = [
        '_sort_order' => 'ASC',
        '_sort_by'    => 'created'
    ];

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name')
            ->add('email')
            ->add('created')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('email')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('email')
            ->add('created')
            ->add('_action', 'actions', [
                'actions' => [
                    #   'view' => [],
                    'edit' => [],
                    'delete' => [],
                ]
            ])
        ;
    }
}