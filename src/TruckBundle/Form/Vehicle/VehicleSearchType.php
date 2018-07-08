<?php

declare(strict_types=1);

namespace TruckBundle\Form\Vehicle;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VehicleSearchType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->setMethod('GET')
            ->add('companyName', TextType::class, [
                'required' => false,
                'label' => 'By company name: '
            ])
            ->add('city', TextType::class, [
                'required' => false,
                'label' => 'By city: '
            ])
            ->add('street', TextType::class, [
                'required' => false,
                'label' => 'By street: '
            ])
            ->add('registrationNumber', TextType::class, [
                'required' => false,
                'label' => 'By registration number: '
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(array(
            'data_class' => 'TruckBundle\Entity\Vehicle',
        ));
    }
}
