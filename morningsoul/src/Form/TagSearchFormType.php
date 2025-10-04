<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

// ChoiceType est obligatoire pour que Symfony accepte un <select> avec des options dynamiques
// choices est vide car Select2 va injecter les options via AJAX
// class:tag-search-select pour cibler le champ dans le JS
class TagSearchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('tag', ChoiceType::class, [
            'choices' => [], // Select2 va remplir dynamiquement
            'label' => false,
            'required' => true,
            'attr' => [
                'class' => 'tag-search-select',
                'data-placeholder' => 'Rechercher un tag...',
                'data-tags' => 'true' 
            ]
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'method' => 'POST'
        ]);
    }
}