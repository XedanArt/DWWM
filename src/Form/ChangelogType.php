<?php

namespace App\Form;

use App\Entity\Changelog;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ChangelogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('version', TextType::class)
            ->add('date', DateTimeType::class, [
                'widget' => 'single_text',
            ])
            ->add('content', TextareaType::class)
            ->add('image', TextType::class, [
                'required' => false,
                'help' => 'Nom du fichier image dans /public/img (ex: changelog_01.png)',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Changelog::class,
        ]);
    }
}