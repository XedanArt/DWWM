<?php

namespace App\Form;

use App\Entity\Changelog;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ChangelogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('version', TextType::class, [
                'label' => 'Version',
                'attr' => [
                    'maxlength' => 20,
                    'placeholder' => 'Ex: 1.2.3'
                ],
            ])
            ->add('date', DateTimeType::class, [
                'widget' => 'single_text',
                'disabled' => true,
                'label' => 'Date de publication',
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Contenu du changelog',
                'attr' => [
                    'maxlength' => 5000,
                    'rows' => 6,
                    'placeholder' => 'Ajout : ...\nCorrection : ...'
                ],
            ])
            ->add('imageFile', FileType::class, [
                'label' => 'Illustration du changelog',
                'mapped' => false,
                'required' => true,
                'help' => 'Sélectionnez une image à importer (max 4 Mo)',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Changelog::class,
            'csrf_protection' => true,
        ]);
    }
}