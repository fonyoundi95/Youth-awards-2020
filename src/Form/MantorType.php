<?php

namespace App\Form;

use App\Entity\Mantor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class MantorType extends AbstractType
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
            ->add('title', TextType::class, $this->config("Nom du Mantor", "Entrez le nom de votre Montor !"))
            ->add('descriptions', TextareaType::class, $this->config("Description", "Entrez une description du mantor !"))
            ->add('image', TextType::class, $this->config("Image du Mantor", "Entrez l'image de votre Montor"));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Mantor::class,
        ]);
    }
}
