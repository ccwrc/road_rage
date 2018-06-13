<?php

namespace TruckBundle\Form\AccidentCase;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccidentCaseEditType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add("damageDescription", "textarea", ["label" => "Damage/fault description: "])
                ->add("location", "textarea", ["label" => "Truck location: "])
                ->add("driverContact", "text", ["label" => "Driver name & phone: "])
                ->add("infoSms", "text", [
                    "label" => "SMS info (optional - phone): ",
                    "required" => false
                ])
                ->add("infoMail", "text", [
                    "label" => "Mail info (optional - mail): ",
                    "required" => false
                ])
                ->add("comment", "textarea", [
                    "label" => "Other comments: "
                ]);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            "data_class" => "TruckBundle\Entity\AccidentCase"
        ]);
    }

}
