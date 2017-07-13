<?php

namespace TruckBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType; // for dealer
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use \DateTime;  // purchase date

class VehicleType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        //
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'TruckBundle\Entity\Vehicle',
        ));
    }

}
