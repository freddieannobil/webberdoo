<?php

namespace Webberdoo\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WidgetType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('body')
            ->add('position', ChoiceType::class, array(
                'choices'  => array(
                    'Home Page Side' => 'home_side',
                    'Footer Left' => 'footer_left',
                    'Footer Center' => 'footer_centre',
                    'Footer Right' => 'footer_right',
                    'Single Video Page Side' => 'single_side',
                    'Page Side' => 'page_side',
                    'Single Video Centre Ad Space' => 'single_video_centre_ad',
                    'Category Page Side' => 'category_side',
                    'Category Page Top' => 'category_top',
                    'Channel and Channels Page Side' => 'channel_side',
                    'Channel and Channels Page Top' => 'channel_top',
                    'Most Viewed Page Side' => 'most_side',
                    'Most Viewed Page Top' => 'most_top',
                )))
            ->add('status');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Webberdoo\AppBundle\Entity\Widget'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_widget';
    }


}
