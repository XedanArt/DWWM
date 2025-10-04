<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Le nom est requis.']),
                    new Length([
                        "min" => 2,
                        "minMessage" => "Le nom doit contenir au minimum {{ limit }} caractères",
                        "max" => 255,
                        "maxMessage" => "Le nom doit contenir au maximum {{ limit }} caractères"
                    ]),
                    new Regex([
                        'pattern' => '/^[^<>]*$/',
                        'message' => 'Les balises HTML ne sont pas autorisées dans le nom.'
                    ])
                ],
                'label' => 'Nom',
                'attr' => ['placeholder' => 'John Doe'],
            ])
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'L\'email est requis.']),
                    new Email(['message' => 'L\'adresse email "{{ value }}" n\'est pas valide.']),
                ],
                'label' => 'Email',
                'attr' => ['placeholder' => 'exemple@domaine.com'],
            ])
            ->add('message', TextareaType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Le message ne peut pas être vide.']),
                    new Length([
                        "min" => 10,
                        "minMessage" => "Le message doit contenir au minimum {{ limit }} caractères",
                        "max" => 1000,
                        "maxMessage" => "Le message doit contenir au maximum {{ limit }} caractères"
                    ]),
                    new Regex([
                        'pattern' => '/^[^<>]*$/',
                        'message' => 'Les balises HTML ne sont pas autorisées dans le message.'
                    ])
                ],
                'label' => 'Message',
                'attr' => ['placeholder' => 'Voici ma demande'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }
}