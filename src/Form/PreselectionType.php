<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use function Sodium\add;

class PreselectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('accessories', CheckboxType::class, [
                'label' => 'Les accessoires sont présents'])
            ->add('system', CheckboxType::class, [
                'label' => 'IOS > 11 ou Android > 8'])
            ->add('screen', CheckboxType::class, [
                'label' => 'Ecran supérieur à 4 pouces'])
            ->add('network', CheckboxType::class, [
                'label' => 'Capte au moins la 4G'])
            ->add('RAM' , NumberType::class, [
                'label' => 'RAM (en Go)'])
            ->add('storage', NumberType::class, [
                'label' => 'Mémoire (en Go)'])
            ->add('save', SubmitType::class, ['label' => 'Commencer l\'estimation'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
