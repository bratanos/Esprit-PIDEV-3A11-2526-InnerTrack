<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Categorie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => false,
            ])
            ->add('contenu', TextareaType::class, [
                'label' => false,
                'attr'  => ['rows' => 8],
            ])
            ->add('datePublication', DateType::class, [
                'label'  => false,
                'widget' => 'single_text',
            ])
            ->add('categorie', EntityType::class, [
                'class'        => Categorie::class,
                'choice_label' => 'nom',
                'label'        => false,
                'placeholder'  => '-- Select a category --',
                'required'     => false,
            ]);
        // NOTE: readability is NOT in the form — it is calculated automatically
        // in ArticleController::new() and edit() via ReadabilityService
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
