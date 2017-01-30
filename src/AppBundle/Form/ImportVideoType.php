<?php

namespace Webberdoo\AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImportVideoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           /* ->add('status', ChoiceType::class, array(
                'choices'  => array(
                    'Active' => true,
                    'InActive' => false,
                )))*/
           ->add('status',CheckboxType::class,[
               'label'=>'Active'
           ])
            ->add('import_feed', ChoiceType::class, array(
                'label'=>'Import Feed',
                'attr'    => array('data-bind' => 'value: import_feed'),
                'choices'  => array(
                    '-Select-'      => '',
                    'Single Video' => 'single_video',
                    'Channel' => 'channel',
                    'Keyword Search' => 'keyword_search',
                )))
            /*->add('category', EntityType::class, array(
                'class' => 'AppBundle:Category',
                'choice_label' => 'name',
                'multiple' => true
            ))*/
            ->add('category', EntityType::class, array(
                'class' => 'AppBundle:Category',
                'choice_label' => 'name',
              //  'multiple' => true
            ))
            ->add('youtube_url')
            ->add('channel_id')
            ->add('add_keywords');
           /* ->add('category', ChoiceType::class, array(
                'choices'  => array(
                    'Cat1' => 'cat_1',
                    'Cat2' => 'cat_2',
                )));*/
            //);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Webberdoo\AppBundle\Entity\Video'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_video';
    }


}
