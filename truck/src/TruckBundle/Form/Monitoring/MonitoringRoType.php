<?php

namespace TruckBundle\Form\Monitoring;

use Symfony\Bridge\Doctrine\Form\Type\EntityType; // for dealer
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MonitoringRoType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add("contactThrough", "text", ["label" => "Contact through: "])
                ->add("comments", "textarea", ["label" => "Comments: "])
                ->add("outComment", "textarea", [
                    "label" => "Comment for repair dealer: ",
                    "required" => false
                ])
                ->add("optionalMails", "textarea", [
                    "label" => "Optional mails to send the document: ",
                    "required" => false
                ])
                ->add("repairDealer", EntityType::class, [
                    //TODO
                    // http://symfony.com/doc/2.8/reference/forms/types/entity.html#using-a-custom-query-for-the-entities
                    "class" => "TruckBundle:Dealer", "choice_label" => "name",
                    "label" => "Repair dealer: "
        ]);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            "data_class" => "TruckBundle\Entity\Monitoring"
        ]);
    }

}
