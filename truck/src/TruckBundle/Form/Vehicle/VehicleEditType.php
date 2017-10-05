<?php

namespace TruckBundle\Form\Vehicle;

use Symfony\Bridge\Doctrine\Form\Type\EntityType; // for dealer
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use \DateTime;  // purchase date

class VehicleEditType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add("vin", "text", ["label" => "Vehicle Identification Number (VIN): "])
                ->add("companyName", "text", ["label" => "Company name: "])
                ->add("taxIdNumber", "text", ["label" => "Tax ID number: "])
                ->add("contactPerson", "text", ["label" => "Contact person (name, phone): "])
                ->add("street", "text", ["label" => "Street: "])
                ->add("zipCode", "text", ["label" => "Zip code: "])
                ->add("city", "text", ["label" => "City: "])
                ->add("phone", "text", [
                    "label" => "Phone: ",
                    "required" => false
                ])
                ->add("fax", "text", [
                    "label" => "Fax: ",
                    "required" => false
                ])
                ->add("mail", "text", [
                    "label" => "Mail: ",
                    "required" => false
                ])
                ->add("registrationNumber", "text", ["label" => "Vehicle registration number: "])
                ->add("mileage", "text", ["label" => "Vehicle mileage: "])
                //TODO guarantee type select option ?
                ->add("guaranteeType", "text", ["label" => "Vehicle guarantee type and end date: "])
                ->add("purchaseDate", "date", ["label" => "Vehicle purchase (sell) date: "])
                ->add("nameType", "text", ["label" => "Vehicle name and type: "])
                ->add("dealer", EntityType::class, [
                    "class" => "TruckBundle:Dealer", "choice_label" => "name",
                    "label" => "Home dealer: "]);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'TruckBundle\Entity\Vehicle',
        ));
    }

}
