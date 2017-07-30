<?php

namespace TruckBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccidentCaseType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
//
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            "data_class" => "TruckBundle\Entity\AccidentCase"
        ]);
    }

}
