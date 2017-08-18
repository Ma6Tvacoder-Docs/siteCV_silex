<?php

namespace MicroCMS\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PersoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('poste', TextType::class)
            ->add('img', TextType::class)
            ->add('facebook', TextType::class)
            ->add('github', TextType::class)
            ->add('codepen', TextType::class)
            ->add('linkedin', TextType::class)
            ->add('twitter', TextType::class)
            ->add('tel', TextType::class)
            ->add('adresse', TextType::class);
    }

    public function getName(){
        return 'perso';
    }
}
