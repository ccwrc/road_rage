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
                    "class" => "TruckBundle:Dealer",
                    "query_builder" => function (\TruckBundle\Repository\DealerRepository $er) {
                        return $er->createQueryBuilder('u')
                                ->where('u.isActive = :active')
                                ->orderBy('u.name', 'ASC')
                                ->setParameter("active", "active");
                    },
                    "choice_label" => "name",
                    "label" => "Repair dealer: "
        ]);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            "data_class" => "TruckBundle\Entity\Monitoring"
        ]);
    }

}
