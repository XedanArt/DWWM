<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\User;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;

class AdminCreationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Adresse email',
                'attr' => ['placeholder' => 'admin@example.com'],
                'constraints' => [
                    new NotBlank(['message' => 'L’email est obligatoire']),
                    new Email(['message' => 'Format d’email invalide']),
                ],
            ])
            ->add('username', TextType::class, [
                'label' => 'Pseudo',
                'attr' => ['placeholder' => 'Nom d’utilisateur'],
                'constraints' => [
                    new NotBlank(['message' => 'Le pseudo est requis']),
                    new Length([
                        'max' => 50,
                        'maxMessage' => 'Le pseudo ne doit pas dépasser {{ limit }} caractères',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                'mapped' => true,
                'label' => 'Mot de passe initial',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Mot de passe sécurisé',
                    'autocomplete' => 'new-password',
                ],
                'constraints' => [
                    new NotBlank(['message' => 'Le mot de passe est requis']),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Le mot de passe doit contenir au moins {{ limit }} caractères',
                    ]),
                    new Regex([
                        'pattern' => '/(?=.*[A-Z])(?=.*[a-z])(?=.*\d)/',
                        'message' => 'Le mot de passe doit contenir une majuscule, une minuscule et un chiffre',
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}