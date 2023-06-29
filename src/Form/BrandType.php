<?php

namespace App\Form;

use App\Entity\Brand;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BrandType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', EntityType::class, [
                'class' => Brand::class,
                'choice_label' => 'name',
                'label' => 'Marque',
                'placeholder' => 'Choisissez une marque',
                'required' => true,
                'autocomplete' => true,
                //'options_as_html' => true,
                'no_results_found_text' => "<span>Désolé je ne connais pas cette marque.</span>", // TODO : add link to contact form
                /*'attr' => [
                    'class' => 'form-control',
                ],*/
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Brand::class,
        ]);
    }
}
