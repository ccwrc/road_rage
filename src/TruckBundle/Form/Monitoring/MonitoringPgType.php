<?php

namespace TruckBundle\Form\Monitoring;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MonitoringPgType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add("contactThrough", "text", ["label" => "Contact through: "])
                ->add("comments", "textarea", ["label" => "Comments: "])
                ->add("amount", "number", ["label" => "Amount: "])
                ->add("currency", "choice", [
                    "choices" => [
                        "PLN" => "PLN",
                        "USD" => "USD",
                        "EUR" => "EUR"
                    ],
                    "choices_as_values" => true, "label" => "Currency: "
                ])
                ->add("outComment", "textarea", [
                    "label" => "Comment for dealer: ",
                    "required" => false
                ])
                ->add("optionalMails", "textarea", [
                    "label" => "Optional mails to send the document: ",
                    "required" => false
        ]);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            "data_class" => "TruckBundle\Entity\Monitoring"
        ]);
    }

}
