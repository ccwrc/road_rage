<?php

namespace TruckBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType; // for dealer
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use \DateTime;  // purchase date

class VehicleType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
        ->add("vin", "text", ["label" => "VIN: "])
         ->add("companyName", "text", ["label" => "Company name: "])       
          ->add("taxIdNumber", "text", ["label" => "Tax ID number: "]);      
                
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'TruckBundle\Entity\Vehicle',
        ));
    }

}
