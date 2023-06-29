<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add("origin", TextType::class, [
                "attr" => [
                    "class" => 'ec-form ec-contact-form-small',
                    "placeholder" => "Votre Adresse"
                ],
                "label" => false
            ])
            ->add("subject", TextType::class, [
                "attr" => [
                    "class" => 'ec-form ec-contact-form-small',
                    "placeholder" => "Sujet"
                ],
                "label" => false
            ])
            ->add("body", TextType::class, [
                "attr" => [
                    "class" => 'ec-form ec-contact-form-big',
                    "placeholder" => "Corps"
                ],
                "label" => false
            ])
            ->setAction("/contact");
    }
}
