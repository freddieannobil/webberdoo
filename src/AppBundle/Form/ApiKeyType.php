<?php

namespace Webberdoo\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ApiKeyType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('youtubeApiKey')
            ->add('disqusShortname')
            ->add('facebookPublicKey', TextType::class,[
                'disabled' => true
            ])
            ->add('facebookSecretKey', TextType::class,[
                'disabled' => true
            ])
            ->add('twitterPublicKey', TextType::class,[
                'disabled' => true
            ])
            ->add('twitterSecretKey', TextType::class,[
                'disabled' => true
            ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Webberdoo\AppBundle\Entity\ApiKey'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_apikey';
    }


}
