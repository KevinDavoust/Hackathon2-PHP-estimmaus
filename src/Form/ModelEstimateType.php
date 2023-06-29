<?php

namespace App\Form;

use App\Entity\Model;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModelEstimateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', ChoiceType::class, [
                'choices' => $options['choices'],
                'choice_label' => 'name',
                'label' => 'Modèle',
                'placeholder' => 'Choisissez un modèle',
                'required' => true,
                'autocomplete' => true,
                //'options_as_html' => true,
                'no_results_found_text' => "<span>Désolé je ne connais pas ce modèle.</span>", // TODO : add link to contact form
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Model::class,
            'choices' => false,
        ]);
    }
}
