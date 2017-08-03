<?php

namespace TruckBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MonitoringType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
//                ->add("name", "text", ["label" => "Dealer name: "])
//                ->add("street", "text", ["label" => "Street: "])

    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            "data_class" => "TruckBundle\Entity\Monitoring"
        ]);
    }

}