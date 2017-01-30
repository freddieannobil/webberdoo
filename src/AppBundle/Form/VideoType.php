<?php

namespace Webberdoo\AppBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VideoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('featured')
            ->add('status',CheckboxType::class,[
                'label'=>'Active'
            ])
            ->add('title')
            ->add('description')
            ->add('category', EntityType::class, array(
                'class' => 'AppBundle:Category',
                'choice_label' => 'name',
                'multiple' => true
            ))
            ->add('thumbnailDefault')
            ->add('thumbnailMedium')
            ->add('thumbnailHigh')
            ->add('videoApiId', TextType::class,[
                'disabled' => true
            ])
            ->add('published', TextType::class,[
                'disabled' => true
            ])
            ->add('duration', TextType::class,[
                'disabled' => true
            ])
            ->add('channelCid', TextType::class,[
                'disabled' => true
            ])
            ->add('channelTitle', TextType::class,[
                'disabled' => true
            ])
            ->add('slug')
            ->add('platform', TextType::class,[
                'disabled' => true
            ])
            ->add('countVisitor', TextType::class,[
                'disabled' => true
            ])

            ->add('likes', TextType::class,[
                'disabled' => true
            ]);
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
