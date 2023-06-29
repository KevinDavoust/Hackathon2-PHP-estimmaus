<?php

namespace App\Form;

use App\Entity\State;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StateEstimateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type', EntityType::class, [
                'class' => State::class,
                'choice_label' => 'type',
                'label' => 'Dans quel état est le smartphone ?',
                'expanded' => true,
                'multiple' => false,
                'required' => true,
                /*'attr' => ['class' => ]*/
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => State::class,
        ]);
    }
}
