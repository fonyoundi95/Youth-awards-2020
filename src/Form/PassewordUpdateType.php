<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class PassewordUpdateType extends AbstractType
{

    private function config($label, $placehold)
    {
        return [
            'label' => $label,
            'attr' => [
                'placeholder' => $placehold
            ]
        ];
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('passeword', PasswordType::class, $this->config("Votre password", "Entrez votre password !"))
            ->add('new_password', PasswordType::class, $this->config("Votre nouveau password", "Entrez votre nouveau password !"))
            ->add('confir_password', PasswordType::class, $this->config("Confirmation", "Confirmez votre nouveau password !"));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
