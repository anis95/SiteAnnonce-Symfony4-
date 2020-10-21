<?php

namespace App\Form;

use App\Entity\Annonce;
use App\Entity\Images;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class AnnonceFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)

    {
        $builder
            ->add('title', TextType::class,
                [
                    'label' => 'Titre',
                    'required' => true,
                    'attr' => [
                        'placeholder' => 'Enter le titre de votre annonce',
                    ],
                    
                ])
            ->add('shor_description', TextType::class,
                [
                    'label' => 'Petite Description',
                    'required' => true,
                    'attr' => [
                        'placeholder' => 'Ecrivez une petite description',
                    ],
                    
                ])
            ->add('description', TextareaType::class,
                [
                    'label' => 'Description',
                    'required' => true,
                    'attr' => [
                        'placeholder' => 'présentez votre annonce',
                    ],
                    
                ])
            ->add('date_at', DateTimeType::class,
                [
                    'widget' => 'single_text',
                    'label' => 'Date',
                    'required' => true,
                    'format' => 'dd/MM/yyyy',
                    'html5' => false,
                    'attr' => [
                        'placeholder' => 'jj/mm/aaaa ex: 21/03/1980',
                    ],
                    
                ])
            ->add('numero_tel', IntegerType::class,
                [
                    'label' => 'Téléphone',
                    'required' => true,
                    
                    'attr' => [
                        'placeholder' => 'Votre numéro de téléphone',
                    ],
                    
                ])
            ->add('lieu', TextType::class,
                [
                    'label' => 'Lieu',
                    'required' => true,
                    'attr' => [
                        'placeholder' => 'lieu annonce',
                    ],
                    
                ])
             ->add('region', EntityType::class, array('class'=>'App\Entity\Region', 
              'choice_label'=>'name',
              'expanded'=>false,
              'multiple'=>false
               ))
            
            ->add('categories', EntityType::class, array('class'=>'App\Entity\Categories', 
              'choice_label'=>'name',
              'expanded'=>false,
              'multiple'=>false
               ))
            ->add('imageFile', FileType::class, [
             'required' => false
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Annonce::class,
        ]);
    }
}
