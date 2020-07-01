<?php

namespace App\Form;

use App\Entity\Advert;
use App\Entity\Brand;
use App\Entity\AdvertType as AdType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdvertType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de l\'annonce'
            ])
            ->add('brand', EntityType::class, [
                'label' => 'Choisissez une marque',
                'class' => Brand::class,
                'choice_label' => 'name'
            ])
            ->add('type', EntityType::class, [
                'label' => 'Type de l\'annonce',
                'class' => AdType::class,
                'choice_label' => 'name'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Advert::class,
        ]);
    }
}
