<?php

namespace TruckBundle\Form\Monitoring;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MonitoringPgType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add("code", "hidden", ["data" => "PG"])
                // TODO timeSave -> auto in controller
                // ->add("timeSave", "datetime", ["label" => "time save: "])
                // ->add("timeSet", "datetime", ["label" => "time set: "])
                // ->add("document", "hidden", ["label" => "document: "])
                ->add("contactThrough", "text", ["label" => "Contact through: "])
                ->add("comments", "textarea", ["label" => "Comments: "])
                //TODO out comment for document
                ->add("outComment", "textarea", ["label" => "Comment for dealer: "]);
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
