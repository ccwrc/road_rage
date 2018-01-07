<?php

namespace TruckBundle\Form\Vehicle;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VehicleSearchType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('companyName', null, [
                    "required" => false,
                    "label" => "By company name: "
                ])
                ->add('city', null, [
                    "required" => false,
                    "label" => "By city: "
                ])
                ->add('street', null, [
                    "required" => false,
                    "label" => "By street: "
                ])
                ->add('registrationNumber', null, [
                    "required" => false,
                    "label" => "By registration number: "
        ]);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'TruckBundle\Entity\Vehicle',
        ));
    }

}
