<?php

namespace TruckBundle\Form\Dealer;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DealerType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add("name", "text", ["label" => "Dealer name: "])
                ->add("street", "text", ["label" => "Street: "])
                ->add("zipCode", "text", ["label" => "Zip code: "])
                ->add("city", "text", ["label" => "City: "])
                ->add("mainPhone", "text", ["label" => "Main phone: "])
                ->add("mainFax", "text", [
                    "label" => "Main fax: ",
                    "required" => false
                    ])
                ->add("mainMail", "text", ["label" => "Main mail: "])
                ->add("phone24h", "text", [
                    "label" => "Phone - 24h: ",
                    "required" => false
                    ])
                ->add("phoneServiceCar", "text", [
                    "label" => "Phone - service car: ",
                    "required" => false
                    ])
                ->add("altPhone1", "text", [
                    "label" => "Phone - optional 1: ",
                    "required" => false
                    ])
                ->add("altPhone2", "text", [
                    "label" => "Phone - optional 2: ",
                    "required" => false
                    ])
                ->add("altMail1", "text", [
                    "label" => "Mail - optional 1: ",
                    "required" => false
                    ])
                ->add("altMail2", "text", [
                    "label" => "Mail - optional 2: ",
                    "required" => false
                    ])
                ->add("isActive", "choice", [
                    "choices" => [
                        "active" => "active",
                        "inactive" => "inactive",
                        "suspended" => "suspended"
                    ],
                    "choices_as_values" => true, "label" => "Is active: "])
                ->add("otherComments", "textarea", [
                    "label" => "Other comments: ",
                    "required" => false
                    ]);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            "data_class" => "TruckBundle\Entity\Dealer"
        ]);
    }

}
