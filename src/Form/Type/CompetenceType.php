<?php

namespace MicroCMS\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
// use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
// ...

class CompetenceType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder

      ->add('categorie', TextType::class)
      ->add('nom', TextType::class)
      ->add('valeur', TextType::class)
      ->add('logo', TextType::class);
  }

  public function getName()
  {
      return 'competence';
  }
}
