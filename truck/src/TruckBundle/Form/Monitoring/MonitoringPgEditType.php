<?php

namespace TruckBundle\Form\Monitoring;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MonitoringPgEditType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add("contactThrough", "text", ["label" => "Contact through: "])
                ->add("comments", "textarea", ["label" => "Comments: "])
                ->add("amount", "number", [
                    "label" => "Amount: ",
                    "read_only" => true
                ])
                ->add("currency", "text", [
                    "label" => "Currency: ",
                    "read_only" => true
                ])
                ->add("outComment", "textarea", [
                    "label" => "Comment for dealer (the document has already been sent): ",
                    "read_only" => true
        ]);
        //TODO contact mail/opt mail for document
        // ->add("contactMail", "hidden", ["label" => "contactMail: "])
        //->add("optionalMails", "text", ["label" => "optionalMails: "]);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            "data_class" => "TruckBundle\Entity\Monitoring"
        ]);
    }

}
