<?php

namespace App\Form;

use App\Entity\NewsInformations;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewsInformationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description')
            //remplacer image ImageName par File 

            ->add('imageFile', VichImageType::class)
            //  ->add('createdAt')
            //  ->add('updatedAt')
            //voir controller car setdate 
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => NewsInformations::class,
        ]);
    }
}
