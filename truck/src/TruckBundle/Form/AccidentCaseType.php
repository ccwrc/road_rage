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
                ->add("status", "hidden", ["label" => "Status: ", "data" => "active"])
                ->add("progress", "hidden", ["label" => "progress: ", "data" => "start"])
                ->add("reportLate", "hidden", ["label" => "Service car late: ", "data" => 0])
                ->add("reportRsTime", "hidden", ["label" => "Road service time: ", "data" => 0])
                ->add("reportNrsTime", "hidden", ["label" => "No road service time: ", "data" => 0])
                ->add("reportRepairTotal", "hidden", ["label" => "Repair total time: ", "data" => 0])
                ->add("reportArrivalTime", "hidden", ["label" => "Arrival time: ", "data" => 0])
                ->add("reportCaseTotal", "hidden", ["label" => "Case total time: ", "data" => 0])
                ->add("reportRepairStatus", "hidden", ["label" => "Repair status: ", "data" => "notification"])
                ->add("comment", "textarea", ["label" => "Other comments: "]);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            "data_class" => "TruckBundle\Entity\AccidentCase"
        ]);
    }

}
