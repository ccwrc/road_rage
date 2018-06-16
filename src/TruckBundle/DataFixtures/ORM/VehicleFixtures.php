<?php

namespace TruckBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use TruckBundle\Entity\Vehicle;

class VehicleFixtures extends Fixture implements DependentFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        // vin: XY + $i (last 8 characters from vin -> $i must be 6 digit)
        for ($i = 200100; $i <= 202100; $i++) {
            $dealer = $manager->getRepository('TruckBundle:Dealer')->find(\mt_rand(1, 75));
            $date = new \DateTime('now - ' . \mt_rand(1, 2000) . "days");

            $vehicle = new Vehicle();
            $vehicle->setCity('city' . $i);
            $vehicle->setCompanyName('company name' . $i);
            $vehicle->setContactPerson('person' . $i);
            $vehicle->setDealer($dealer);
            $vehicle->setGuaranteeType('GuaranteeType' . $i);
            $vehicle->setMileage('3' . $i);
            $vehicle->setNameType('truck ' . $i);
            $vehicle->setPhone('123123123');
            $vehicle->setPurchaseDate($date);
            $vehicle->setRegistrationNumber('reg' . $i);
            $vehicle->setStreet('street ' . $i);
            $vehicle->setTaxIdNumber('tax ' . $i);
            $vehicle->setVin('XY' . $i);
            $vehicle->setZipCode(mt_rand(10, 99) . "-998");

            $manager->persist($vehicle);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            DealerFixtures::class
        ];
    }
}
