<?php

namespace App\Form;

use App\Entity\Pet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $dangerousBreeds = ['Pitbull', 'Mastiff'];

        $builder
            ->add('name', TextType::class)
            ->add('type', ChoiceType::class, [
                'choices' => ['Dog' => 'dog', 'Cat' => 'cat'],
                'placeholder' => 'Choose type',
            ])
            ->add('breed', ChoiceType::class, [
                'choices' => [
                    'Pitbull' => 'Pitbull',
                    'Mastiff' => 'Mastiff',
                    'Golden Retriever' => 'Golden Retriever',
                    'Siamese' => 'Siamese',
                    'Persian' => 'Persian',
                    "I don't know" => "I don't know",
                    "It's a mix" => "It's a mix"
                ],
                'placeholder' => "Choose Breed",
            ])
            ->add('dateOfBirth', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('sex', ChoiceType::class, [
                'choices' => ['Male' => 'male', 'Female' => 'female'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pet::class,
        ]);
    }
}
