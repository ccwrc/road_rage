<?php

namespace TruckBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use TruckBundle\Entity\Dealer;

class DealerFixtures extends Fixture implements DependentFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 50; $i++) {
            $inactiveDealer = new Dealer();
            $inactiveDealer->setAltMail1($i . 'inactivedealer@pp.elo');
            $inactiveDealer->setAltPhone1('123456789');
            $inactiveDealer->setCity($i . 'city');
            $inactiveDealer->setIsActive(Dealer::$dealerIsInactive);
            $inactiveDealer->setMainFax('123456789');
            $inactiveDealer->setMainMail($i . 'inactivedealer@pp.1mail');
            $inactiveDealer->setMainPhone($i . '12345678');
            $inactiveDealer->setName('inactive Dealer' . $i);
            $inactiveDealer->setOtherComments('plain comment' . $i);
            $inactiveDealer->setPhone24h($i . '87654321');
            $inactiveDealer->setPhoneServiceCar('12345699' . $i);
            $inactiveDealer->setStreet('street' . $i);
            $inactiveDealer->setZipCode(\mt_rand(10, 99) . '-225');
            $manager->persist($inactiveDealer);
        }

        for ($i = 51; $i <= 75; $i++) {
            $activeDealer = new Dealer();
            $activeDealer->setAltMail1($i . 'activedealer@pp.elo');
            $activeDealer->setAltPhone1('123456789');
            $activeDealer->setCity($i . 'city');
            $activeDealer->setIsActive(Dealer::$dealerIsActive);
            $activeDealer->setMainFax('123456789');
            $activeDealer->setMainMail($i . 'activedealer@pp.1mail');
            $activeDealer->setMainPhone($i . '12345678');
            $activeDealer->setName('Active Dealer' . $i);
            $activeDealer->setOtherComments('plain comment' . $i);
            $activeDealer->setPhone24h($i . '87654321');
            $activeDealer->setPhoneServiceCar('12345699' . $i);
            $activeDealer->setStreet('street' . $i);
            $activeDealer->setZipCode(\mt_rand(10, 99) . '-225');
            $manager->persist($activeDealer);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
