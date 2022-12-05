<?php

namespace App\Form;

use App\Entity\Game;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('releaseDate')
            ->add('types', EntityType::class, [
                'class' => 'App\Entity\Type',
                'choice_label' => 'designation',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('genres', EntityType::class, [
                'class' => 'App\Entity\Genre',
                'choice_label' => 'designation',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('platforms', EntityType::class, [
                'class' => 'App\Entity\Platform',
                'choice_label' => 'designation',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('publisher', EntityType::class, [
                'class' => 'App\Entity\Publisher',
                'choice_label' => 'designation',
            ])
            ->add('developers', EntityType::class, [
                'class' => 'App\Entity\Developer',
                'choice_label' => 'designation',
                'multiple' => true,
                'expanded' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}
