<?php

namespace App\Form;

use App\Entity\Autor;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AutorType extends AbstractType
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
            ->add('name', TextType::class, $this->config("Votre Nom", "Entrez votre Nom !"))
            ->add('email', EmailType::class, $this->config("Votre Email", "Entrez boite mail !"))
            ->add('passeword', PasswordType::class, $this->config("Votre mot de passe", "Entrez votre mot de passe !"))
            ->add('confirm_passeword', PasswordType::class, $this->config("Confirmez votre mot de passe", "Entrez le meme mot de passe !"));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Autor::class,
        ]);
    }
}
