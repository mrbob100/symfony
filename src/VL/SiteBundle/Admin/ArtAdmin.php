<?php
namespace VL\SiteBundle\Admin;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use VL\SiteBundle\Entity\Art;

class ArtAdmin extends Admin
{
    protected $datagridValues = [
        '_sort_order' => 'DESC',
        '_sort_by' => 'created_at'
    ];

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('category')
            ->add('author')
            ->add('nazvanie')
            ->add('nick_name')
          #  ->add('file', 'file', ['label' => 'Сайт мистера Боба', 'required' => false])
            ->add('short_cont','textarea', array('attr'=>array('class'=>'ckeditor'), 'required' => false))
            ->add('content','textarea', array('attr'=>array('class'=>'ckeditor'), 'required' => false))
            ->add('is_public', null, ['label' => 'Опубликовать?'])
            ->add('keywords')
            ->add('descriptin')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('category')
            ->add('author')
            ->add('nazvanie')

        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('nazvanie')
            ->add('nick_name')
            ->add('category')
            ->add('short_cont')
            ->add('_action', 'actions', [
                'actions' => [
                #   'view' => [],
                    'edit' => [],
                    'delete' => [],
                ]
            ])
        ;
    }

    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper
            ->add('category')
            ->add('author')
            ->add('webPath', 'string', ['template' => 'VLSiteBundle:ArtAdmin:list_image.html.twig'])
            ->add('nick_name')
            ->add('nazvanie')
            ->add('short_cont')
            ->add('content')
        #    ->add('how_to_apply')
            ->add('is_public')
            ->add('token')
            ->add('keywords')
            ->add('descriptin')


        ;
    }

    public function getBatchActions()
    {
        $actions = parent::getBatchActions();

        // проверка прав пользователя
        if($this->hasRoute('edit') && $this->isGranted('EDIT') && $this->hasRoute('delete') && $this->isGranted('DELETE')) {
            $actions['extend'] = [
                'label'            => 'Продлить',
                'ask_confirmation' => true // Если true, будет выведено сообщение о подтверждении действия
            ];
        }
        $actions['deleteNeverActivated'] = [
            'label'            => 'Удалить просроченные статьи',
            'ask_confirmation' => true // Если true, будет выведено сообщение о подтверждении действия
        ];
        return $actions;
    }

}