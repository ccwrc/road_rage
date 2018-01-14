<?php

namespace TruckBundle\Form\AccidentCase;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

// TODO finish it
class AccidentCaseSearchType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                //->setMethod('GET') //for pagination
//                ->add('companyName', null, [
//                    "required" => false,
//                    "label" => "By company name: "
//                ])
//                ->add('city', null, [
//                    "required" => false,
//                    "label" => "By city: "
//                ])
//                ->add('street', null, [
//                    "required" => false,
//                    "label" => "By street: "
//                ])
                ->add('reportCaseTotal', null, [ // temporary solution...
                    "required" => false,
                    "label" => "By case number: "
        ]);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'TruckBundle\Entity\AccidentCase',
        ));
    }

}
