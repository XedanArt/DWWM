<?php

namespace App\Form;

use App\Entity\Announcement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

class AnnouncementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

    $builder
        ->add('title', TextType::class, [
            'label' => 'Titre de l’annonce',
            'constraints' => [
                new NotBlank(['message' => 'Le titre est obligatoire.']),
                new Length([
                    'min' => 5,
                    'max' => 100,
                    'minMessage' => 'Le titre doit contenir au moins {{ limit }} caractères.',
                    'maxMessage' => 'Le titre ne peut pas dépasser {{ limit }} caractères.',
                ]),
            ],
        ])
        ->add('content', TextareaType::class, [
            'label' => 'Contenu',
            'constraints' => [
                new NotBlank(['message' => 'Le contenu est obligatoire.']),
                new Length([
                    'min' => 20,
                    'max' => 1000,
                    'minMessage' => 'Le contenu doit contenir au moins {{ limit }} caractères.',
                    'maxMessage' => 'Le contenu ne peut pas dépasser {{ limit }} caractères.',
                ]),
            ],
        ]);
    }
}