<?php

namespace TruckBundle\Form\Monitoring;

use Symfony\Bridge\Doctrine\Form\Type\EntityType; // for dealer
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use TruckBundle\Repository\DealerRepository; // for query_builder

class MonitoringRoType extends AbstractType {

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
                    "label" => "Comment for repair dealer: ",
                    "required" => false
                ])
                ->add("optionalMails", "textarea", [
                    "label" => "Optional mails to send the document: ",
                    "required" => false
                ])
                ->add("repairDealer", EntityType::class, [
                    "class" => "TruckBundle:Dealer",
                    "query_builder" => function (DealerRepository $dr) {
                        return $dr->createQueryBuilder('dealer')
                                ->where('dealer.isActive = :active')
                                ->orderBy('dealer.name', 'ASC')
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
