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
        for ($i=1; $i <= 50; $i++) {
            $inactiveDealer = new Dealer();
            $inactiveDealer->setAltMail1($i . 'inactivedealer@pp.elo');
            $inactiveDealer->setAltPhone1('123456789');
            $inactiveDealer->setCity($i . 'city');
            $inactiveDealer->setIsActive(Dealer::$active);
        }
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}