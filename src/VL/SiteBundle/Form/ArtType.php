<?php

namespace VL\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ArtType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type')
            ->add('author')
            ->add('nick_name')
            ->add('nazvanie')
            ->add('url')
            ->add('short_cont')
            ->add('content','genemu_tinymce')
            ->add('img')
            ->add('token')
            ->add('is_public')
            ->add('is_activated')
            ->add('expires_at')
            ->add('created_at')
            ->add('updated_at')
            ->add('category')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'VL\SiteBundle\Entity\Art'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'vl_sitebundle_art';
    }
}
