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
                //TODO out comment for document
                ->add("outComment", "textarea", ["label" => "Comment for repair dealer: "])
                //TODO contact mail/opt mail for document
                // ->add("contactMail", "hidden", ["label" => "contactMail: "])
                //->add("optionalMails", "text", ["label" => "optionalMails: "]);
                ->add("repairDealer", EntityType::class, [
                    "class" => "TruckBundle:Dealer", "choice_label" => "name",
                    "label" => "Repair dealer: "]);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            "data_class" => "TruckBundle\Entity\Monitoring"
        ]);
    }

}
