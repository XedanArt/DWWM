<?php

namespace App\Form;

use App\Entity\Topic;
use App\Entity\ForumSection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TopicFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('section', EntityType::class, [
                'label' => 'Catégorie',
                'class' => ForumSection::class,
                'choice_label' => 'title',
                'placeholder' => '-- Choisissez une catégorie --',
                'attr' => [
                    'class' => 'form-select',
                ],
            ])
            ->add('title', TextType::class, [
                'label' => 'Titre du sujet',
                'attr' => [
                    'placeholder' => 'Entrez le titre du sujet',
                    'class' => 'form-control',
                ],
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Contenu',
                'required' => false, // important pour TinyMCE
                'attr' => [
                    'placeholder' => 'Décrivez votre sujet ici...',
                    'rows' => 8,
                    'class' => 'form-control tinymce',
                ],
            ])
            ->add('tags', TextType::class, [
                'label' => 'Tags',
                'required' => false,
                'mapped' => false,
                'attr' => [
                    'class' => 'tag-input-hidden',
                    'style' => 'display:none',
                    'placeholder' => 'Sélectionnez ou créez des tags',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Topic::class,
            'available_tags' => [],
        ]);
    }

    public function getBlockPrefix(): string
    {
        return 'topic';
    }
}