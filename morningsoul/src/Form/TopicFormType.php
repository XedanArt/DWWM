<?php

namespace App\Form;

use App\Entity\Topic;
use App\Entity\ForumSection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

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
                'attr' => ['class' => 'form-select'],
            ])
            ->add('title', TextType::class, [
                'label' => 'Titre du sujet',
                'attr' => [
                    'placeholder' => 'Entrez le titre du sujet',
                    'class' => 'form-control',
                ],
                'constraints' => [
                    new NotBlank(['message' => 'Le titre ne peut pas être vide.']),
                    new Length([
                        'max' => 150,
                        'maxMessage' => 'Le titre ne doit pas dépasser 150 caractères.',
                    ]),
                    new Regex([
                        'pattern' => '/<script\b[^>]*>(.*?)<\/script>/i',
                        'match' => false,
                        'message' => 'Le titre ne doit pas contenir de balises <script>.',
                    ]),
                    new Regex([
                        'pattern' => '/https?:\/\/[^\s]+/i',
                        'match' => false,
                        'message' => 'Le titre ne doit pas contenir de lien URL.',
                    ]),
                ],
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Contenu',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Décrivez votre sujet ici...',
                    'rows' => 8,
                    'class' => 'form-control tinymce',
                ],
                'constraints' => [
                    new Length([
                        'max' => 6000,
                        'maxMessage' => 'Le contenu HTML ne doit pas dépasser 6000 caractères.',
                    ]),
                    new Regex([
                        'pattern' => '/<script\b[^>]*>(.*?)<\/script>/i',
                        'match' => false,
                        'message' => 'Le contenu ne doit pas contenir de balises <script>.',
                    ]),
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
                'constraints' => [
                    new Regex([
                        'pattern' => '/^[a-zA-Z0-9À-ÿ,\s\-]*$/u',
                        'message' => 'Les tags ne doivent contenir que des lettres, chiffres, tirets ou virgules.',
                    ]),
                ],
            ]);

        // Nettoyage du champ content avant validation
        $builder->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
            $data = $event->getData();

            if (isset($data['content'])) {
                $raw = $data['content'];
                $cleaned = preg_replace('/^<(p|span)[^>]*>(.*?)<\/\1>$/is', '$2', trim($raw));
                $cleaned = strip_tags($cleaned, '<a><b><strong><i><em><br>');
                $data['content'] = $cleaned;
                $event->setData($data);
            }
        });
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