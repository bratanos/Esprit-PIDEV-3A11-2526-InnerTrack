<?php

namespace App\Form\Journal;

use App\Entity\Journal\Habitude;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\RangeType;

class HabitudeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomHabitude', TextType::class, [
                'label' => '🌿 Nom de l\'habitude',
                'empty_data' => '',
                'constraints' => [
                    new Assert\NotBlank(message: 'Le nom est obligatoire'),
                    new Assert\Length(['max' => 255]),
                ],
                'attr' => [
                    'class'       => 'w-full rounded-xl border border-gray-200 px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#006876]',
                    'placeholder' => 'Ex: Méditation, Sport, Lecture...',
                ],
            ])
            ->add('emotionDominantes', ChoiceType::class, [
                'label'   => '💭 Émotion dominante',
                'placeholder'  => '— Choisir votre émotion —',
                'empty_data'  => '',
                'required'    => true,
                'constraints' => [
                    new Assert\NotBlank(message: 'Veuillez choisir une émotion'),
                ],
                'choices' => array_combine(
                    ['Joie','Sérénité','Motivation','Calme','Énergie',
                     'Détente','Concentration','Colère','Tristesse',
                     'Anxiété','Confiance','Gratitude'],
                    ['Joie','Sérénité','Motivation','Calme','Énergie',
                     'Détente','Concentration','Colère','Tristesse',
                     'Anxiété','Confiance','Gratitude']
                ),
                'attr' => [
                    'class' => 'w-full rounded-xl border border-gray-200 px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#006876]',
                ],
            ])
            ->add('niveauEnergie', RangeType::class, [
    'label' => '⚡ Niveau d\'énergie',
    'constraints' => [
        new Assert\NotBlank(),
        new Assert\Range([
            'min' => 0,
            'max' => 10,
        ]),
    ],
    'attr' => [
        'min' => 0,
        'max' => 10,
        'step' => 1,
        'class' => 'slider-energie',
        'oninput' => "updateSlider(this, 'val_energie', 'energie')",
    ],
])

            ->add('niveauStress', RangeType::class, [
    'label' => '😰 Niveau de stress',
    'constraints' => [
        new Assert\NotBlank(),
        new Assert\Range([
            'min' => 0,
            'max' => 10,
        ]),
        ],
        'attr' => [
        'min'   => 0,
        'max'   => 10,
        'step'  => 1,
        'class' => 'slider-stress',
        'oninput' => "updateSlider(this, 'val_stress', 'stress')",
    ],
            ])
            ->add('qualiteSommeil', RangeType::class, [
    'label' => '😴 Qualité du sommeil',
    'constraints' => [
        new Assert\NotBlank(),
        new Assert\Range([
            'min' => 0,
            'max' => 10,
            'notInRangeMessage' => 'La valeur doit être entre 0 et 10',
        ]),
                ],
                'attr' => [
        'min'   => 0,
        'max'   => 10,
        'step'  => 1,
        'class' => 'slider-sommeil',
        'oninput' => "updateSlider(this, 'val_sommeil', 'sommeil')",
    ],
            ])
            ->add('noteTextuelle', TextareaType::class, [
                'label'    => '📝 Note personnelle',
                'required' => false,
                'attr'     => [
                    'class'       => 'w-full rounded-xl border border-gray-200 px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#006876]',
                    'rows'        => 4,
                    'placeholder' => 'Comment vous sentez-vous aujourd\'hui ?',
                ],
            ])
            ->add('dateCreation', DateType::class, [
                'label'  => '📅 Date',
                'widget' => 'single_text',
                //'data'   => new \DateTime(),
                'attr'   => [
                    'class' => 'w-full rounded-xl border border-gray-200 px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#006876]',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => Habitude::class]);
    }
}