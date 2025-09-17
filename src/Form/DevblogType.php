<?php

namespace App\Form;

use App\Entity\Devblog;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

class DevblogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre du Devblog',
                'attr' => [
                    'maxlength' => 100,
                    'placeholder' => 'Ex: Nouveau Raid : Kraken'
                ],
            ])
            ->add('date', DateTimeType::class, [
                'label' => 'Date de publication',
                'widget' => 'single_text',
                'data' => new \DateTimeImmutable(),
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Contenu du Devblog',
                'attr' => [
                    'maxlength' => 5000,
                    'rows' => 6,
                    'placeholder' => 'Décrivez les nouveautés, les changements, etc.'
                ],
            ])
            ->add('imageFile', FileType::class, [
                'label' => 'Illustration du Devblog',
                'mapped' => false,
                'required' => true,
                'help' => 'Sélectionnez une image à importer (max 4 Mo)',
                'constraints' => [
                    new File([
                        'maxSize' => '4M',
                        'mimeTypes' => ['image/jpeg', 'image/png', 'image/gif'],
                        'mimeTypesMessage' => 'Merci d\'uploader une image valide (JPEG, PNG ou GIF).',
                    ])
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Devblog::class,
            'csrf_protection' => true,
        ]);
    }
}