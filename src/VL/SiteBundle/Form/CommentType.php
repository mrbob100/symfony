<?php
namespace VL\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CommentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name','text',array('attr' => array('class' => 'hgot')))
            ->add('email','text',array('attr' => array('class' => 'hgot')))
            ->add('file', 'file', ['label' => 'Разумная экономика', 'required' => false])
            ->add('content','textarea',array('attr' => array('class' => 'hgot1')));

          # ->add('recaptcha', 'recaptcha', array(
          #     'widget_options' => array(
            #       'theme' => 'clean'
            #   )
           # ));
    }

        /**
         * @param OptionsResolverInterface $resolver
         */
        public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'VL\SiteBundle\Entity\Comment'
        ));
    }

        /**
         * @return string
         */
        public function getName()
    {
        return 'vl_sitebundle_comment';
    }

}

