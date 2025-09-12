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
use Symfony\Component\Validator\Constraints as Assert;

class ChangelogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('version', TextType::class, [
                'label' => 'Version',
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'La version est obligatoire.',
                    ]),
                    new Assert\Length([
                        'max' => 50,
                        'maxMessage' => 'La version ne peut pas dépasser 50 caractères.',
                    ]),
                    new Assert\Regex([
                        'pattern' => '/^\d+(\.\d+)*$/',
                        'message' => 'Format de version invalide. Exemple : 1.2.3',
                    ]),
                ],
            ])
            ->add('date', DateTimeType::class, [
                'widget' => 'single_text',
                'disabled' => true,
                'label' => 'Date de publication',
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Contenu du changelog',
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Le contenu est obligatoire.',
                    ]),
                    new Assert\Length([
                        'max' => 2000,
                        'maxMessage' => 'Le contenu ne peut pas dépasser 2000 caractères.',
                    ]),
                ],
            ])
            ->add('imageFile', FileType::class, [
                'label' => 'Illustration du changelog',
                'mapped' => false,
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Veuillez sélectionner une image.',
                    ]),
                    new Assert\Image([
                        'maxSize' => '4M',
                        'mimeTypesMessage' => 'Formats autorisés : JPG, PNG, GIF',
                    ]),
                ],
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