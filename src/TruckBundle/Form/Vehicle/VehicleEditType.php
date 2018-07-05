<?php

declare(strict_types=1);

namespace TruckBundle\Form\Vehicle;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VehicleEditType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('vin', TextType::class, [
                'label' => 'Vehicle Identification Number (VIN): '
            ])
            ->add('companyName', TextType::class, [
                'label' => 'Company name: '
            ])
            ->add('taxIdNumber', TextType::class, [
                'label' => 'Tax ID number: '
            ])
            ->add('contactPerson', TextType::class, [
                'label' => 'Contact person (name, phone): '
            ])
            ->add('street', TextType::class, [
                'label' => 'Street: '
            ])
            ->add('zipCode', TextType::class, [
                'label' => 'Zip code: '
            ])
            ->add('city', TextType::class, [
                'label' => 'City: '
            ])
            ->add('phone', TextType::class, [
                'label' => 'Phone: ',
                'required' => false
            ])
            ->add('fax', TextType::class, [
                'label' => 'Fax: ',
                'required' => false
            ])
            ->add('mail', TextType::class, [
                'label' => 'Mail: ',
                'required' => false
            ])
            ->add('registrationNumber', TextType::class, [
                'label' => 'Vehicle registration number: '
            ])
            ->add('mileage', TextType::class, [
                'label' => 'Vehicle mileage: '
            ])
            ->add('guaranteeType', TextType::class, [
                'label' => 'Vehicle guarantee type and end date: '
            ])
            ->add('purchaseDate', BirthdayType::class, [
                'label' => 'Vehicle purchase (sell) date: '
            ])
            ->add('nameType', TextType::class, [
                'label' => 'Vehicle name and type: '
            ])
            ->add('dealer', EntityType::class, [
                'class' => 'TruckBundle:Dealer',
                'choice_label' => 'name',
                'label' => 'Home dealer: '
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(array(
            'data_class' => 'TruckBundle\Entity\Vehicle',
        ));
    }
}
