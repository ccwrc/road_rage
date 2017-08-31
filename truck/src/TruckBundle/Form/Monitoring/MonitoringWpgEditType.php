<?php

namespace TruckBundle\Form\Monitoring;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MonitoringWpgEditType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add("contactThrough", "text", ["label" => "Contact through: "])
                ->add("comments", "textarea", ["label" => "Comments: "]);
        //TODO out comment for document
        //out comment -> sorry, document already sent
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            "data_class" => "TruckBundle\Entity\Monitoring"
        ]);
    }

}
