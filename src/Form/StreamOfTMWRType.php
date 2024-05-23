<?php

namespace App\Form;

use App\Entity\Jeu;
use App\Entity\Stream;
use App\Entity\StreamOfTMWR;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StreamOfTMWRType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('user', EntityType::class, [
                'class' => User::class,
'choice_label' => 'id',
            ])
            ->add('PlayAT', EntityType::class, [
                'class' => Jeu::class,
'choice_label' => 'id',
            ])
            ->add('link', EntityType::class, [
                'class' => Stream::class,
'choice_label' => 'id',
            ])
            ->add('date', EntityType::class, [
                'class' => Stream::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => StreamOfTMWR::class,
        ]);
    }
}
