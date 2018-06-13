<?php

namespace TruckBundle\Form\AccidentCase;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccidentCaseEditEndType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add("reportLate", "number", ["label" => "Service car late: "])
                ->add("reportRsTime", "number", ["label" => "Road service time: "])
                ->add("reportNrsTime", "number", ["label" => "No road service time: "])
                ->add("reportRepairTotal", "number", ["label" => "Repair total time: "])
                ->add("reportArrivalTime", "number", ["label" => "Arrival time: "])
                ->add("reportCaseTotal", "number", ["label" => "Case total time: "])
                ->add("reportRepairStatus", "choice", [
                    "choices" => [
                        "completed" => "completed",
                        "incompleted" => "incompleted",
                        "canceled" => "canceled"
                    ],
                    "choices_as_values" => true, "label" => "Repair status: "]);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            "data_class" => "TruckBundle\Entity\AccidentCase"
        ]);
    }

}
