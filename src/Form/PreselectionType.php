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
                'label' => 'Le chargeur et la batterie sont présents'])
            ->add('system', CheckboxType::class, [
                'label' => 'La version du système est supérieure à IOS 11 ou Android 8'])
            ->add('screen', CheckboxType::class, [
                'label' => "L'écran fait plus de 4 pouces"])
            ->add('network', CheckboxType::class, [
                'label' => 'Le téléphone capte au moins la 4G'])
            ->add('save', SubmitType::class, ['label' => 'Passer à l\'étape suivante'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
