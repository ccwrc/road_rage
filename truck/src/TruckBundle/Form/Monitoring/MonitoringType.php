<?php

namespace TruckBundle\Form\Monitoring;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MonitoringType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add("code", "text", ["label" => "Code: ", "data" => "testCode"])
                ->add("codeDescription", "text", ["label" => "code description: "])
                ->add("timeSave", "datetime", ["label" => "time save: "])
                ->add("timeSet", "datetime", ["label" => "time set: "])
                ->add("document", "hidden", ["label" => "document: "])
                ->add("contactThrough", "text", ["label" => "Contact through: "])
                ->add("comments", "textarea", ["label" => "comments: "])
                ->add("outComment", "hidden", ["label" => "outComment: "])
                ->add("homeDealerId", "hidden", ["label" => "homeDealerId: "])
                ->add("repairDealerId", "hidden", ["label" => "repairDealerId: "])
                ->add("contactMail", "hidden", ["label" => "contactMail: "])
                ->add("optionalMails", "text", ["label" => "optionalMails: "]);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            "data_class" => "TruckBundle\Entity\Monitoring"
        ]);
    }

}
