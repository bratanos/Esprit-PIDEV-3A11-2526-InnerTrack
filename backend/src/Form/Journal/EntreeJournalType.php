<?php

namespace App\Form\Journal;

use App\Entity\Journal\EntreeJournal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class EntreeJournalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('humeur', RangeType::class, [
                'label'       => '😊 Humeur du jour',
                'constraints' => [new Assert\Range(['min' => 1, 'max' => 10])],
                'attr'        => [
                    'class' => 'w-full accent-[#006876]',
                    'min'   => 1,
                    'max'   => 10,
                    'step'  => 1,
                    'class' => 'slider-humeur',
                    'oninput' => 'updateHumeur(this)',
                ],
            ])

            ->add('noteTextuelle', TextareaType::class, [
                'label'    => '📝 Note du jour',
                'required' => true,
                'empty_data' => '',
                'constraints' => [
                    new Assert\NotBlank(message: 'La note est obligatoire'),  // ← ajouter
                    new Assert\Length([
                        'max' => 1000,
                        'maxMessage' => 'La note ne peut pas dépasser 1000 caractères',
                    ]),
                ],
                'attr'     => [
                    'class'       => 'w-full rounded-xl border border-gray-200 px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#006876]',
                    'rows'        => 5,
                    'placeholder' => 'Comment s\'est passée votre journée ?',
                ],
            ])
            ->add('dateSaisie', DateType::class, [
                'label'  => '📅 Date',
                'widget' => 'single_text',
                'data'   => new \DateTime(),
                'attr'   => [
                    'class' => 'w-full rounded-xl border border-gray-200 px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#006876]',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => EntreeJournal::class]);
    }
}