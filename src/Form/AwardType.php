<?php

namespace App\Form;

use App\Entity\Award;
use DateTime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AwardType extends AbstractType

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
            ->add('title', TextType::class, $this->config("Titre de l'award", " Entrez le titre de votre Award !"))
            ->add('conten', TextareaType::class, $this->config("Resumer de l'award", "Faites un resumer sur l'award en question !"))
            ->add('imag', TextareaType::class, $this->config("Image de l'Award", "Selectionez une image pour l'award !"))
            ->add('cathegori')
            ->add('createAd');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Award::class,
        ]);
    }
}
