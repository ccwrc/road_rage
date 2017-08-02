<?php

namespace TruckBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccidentCaseEditEndType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add("reportLate", "hidden", ["label" => "Service car late: "])
                ->add("reportRsTime", "hidden", ["label" => "Road service time: "])
                ->add("reportNrsTime", "hidden", ["label" => "No road service time: "])
                ->add("reportRepairTotal", "hidden", ["label" => "Repair total time: "])
                ->add("reportArrivalTime", "hidden", ["label" => "Arrival time: "])
                ->add("reportCaseTotal", "hidden", ["label" => "Case total time: "])
                ->add("reportRepairStatus", "hidden", ["label" => "Repair status: "]);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            "data_class" => "TruckBundle\Entity\AccidentCase"
        ]);
    }

}
