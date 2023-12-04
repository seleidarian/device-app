<?php

namespace App\Form\Type;

use EasyCorp\Bundle\EasyAdminBundle\Form\Filter\Type\ChoiceFilterType;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\ComparisonType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GenerationFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('comparison', HiddenType::class, [
                'data' => ComparisonType::CONTAINS,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'value_type' => ChoiceType::class,
            'value_type_options' => [
                'multiple' => true,
                'row_attr' => [
                    'style' => 'margin-top: -12px;', // just to eliminate the ugly margin
                ],
            ],
        ]);
    }

    public function getParent(): string
    {
        return ChoiceFilterType::class;
    }
}
