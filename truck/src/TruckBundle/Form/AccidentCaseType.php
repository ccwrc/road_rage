<?php

namespace TruckBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccidentCaseType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add("damageDescription", "textarea", ["label" => "Damage/fault description: "])
                ->add("location", "textarea", ["label" => "Truck location: "])
                ->add("driverContact", "text", ["label" => "Driver name & phone: "])
                ->add("infoSms", "text", ["label" => "SMS info (optional - phone): "])
                ->add("infoMail", "text", ["label" => "Mail info (optional - mail): "])
                ->add("status", "text", ["label" => "Status: "])
                ->add("progress", "text", ["label" => "progress: "])
//                ->add("reportLate", "text", ["label" => "reportLate: "])
//                ->add("reportRsTime", "text", ["label" => "reportRsTime: "])
//                ->add("reportNrsTime", "text", ["label" => "reportNrsTime: "])
//                ->add("reportRepairTotal", "text", ["label" => "reportRepairTotal: "])
//                ->add("reportArrivalTime", "text", ["label" => "reportArrivalTime: "])
//                ->add("reportCaseTotal", "text", ["label" => "reportCaseTotal: "])
//                ->add("reportRepairStatus", "text", ["label" => "reportRepairStatus: "])
                ->add("comment", "textarea", ["label" => "Other comments: "]);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            "data_class" => "TruckBundle\Entity\AccidentCase"
        ]);
    }

}
