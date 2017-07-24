<?php

namespace TruckBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType; // for dealer -> del
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use \DateTime;  // purchase date -> del

class DealerType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add("name", "text", ["label" => "Dealer/Service name: "])
                ->add("street", "text", ["label" => "Localization - street: "])
                ->add("zipCode", "text", ["label" => "Localization - zip code: "])
                ->add("city", "text", ["label" => "Localization - city: "])
                ->add("name", "text", ["label" => "Dealer/Service name: "])
                ->add("name", "text", ["label" => "Dealer/Service name: "])
                ->add("name", "text", ["label" => "Dealer/Service name: "])
                ->add("name", "text", ["label" => "Dealer/Service name: "])
                ->add("name", "text", ["label" => "Dealer/Service name: "]);
//                ->add("mail", "text", ["label" => "Mail: "])
//                ->add("registrationNumber", "text", ["label" => "Vehicle registration number: "])
//                ->add("mileage", "text", ["label" => "Vehicle mileage: "])
//                //TODO g type select option ?
//                ->add("guaranteeType", "text", ["label" => "Vehicle guarantee type and end date: "])
//                ->add("purchaseDate", "date", ["label" => "Vehicle purchase (sell) date: "])
//                ->add("nameType", "text", ["label" => "Vehicle name and type: "])
//                ->add("dealer", EntityType::class, [
//                    "class" => "TruckBundle:Dealer", "choice_label" => "name",
//                    "label" => "Home dealer: "]);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'TruckBundle\Entity\Dealer',
        ));
    }

}
