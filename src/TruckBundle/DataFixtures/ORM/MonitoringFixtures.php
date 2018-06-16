<?php

namespace TruckBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use TruckBundle\Entity\AccidentCase;
use TruckBundle\Entity\Monitoring;

class MonitoringFixtures extends Fixture implements DependentFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 3000; $i++) {
            $accidentCase = $manager->getRepository('TruckBundle:AccidentCase')->find(\mt_rand(1, 3040));

            $monitoringIncoming = new Monitoring();
            $monitoringIncoming->setAccidentCase($accidentCase)
                ->setOperator('plainOperator')
                ->setCode(Monitoring::$codeIncoming)
                ->setContactThrough('plain cont')
                ->setComments('plain operator comment');
            $manager->persist($monitoringIncoming);
        }

        for ($i = 1; $i <= 5000; $i++) {
            $accidentCase = $manager->getRepository('TruckBundle:AccidentCase')->find(\mt_rand(1, 3040));

            $monitoringOut = new Monitoring();
            $monitoringOut->setAccidentCase($accidentCase)
                ->setOperator('operatorOut')
                ->setCode(Monitoring::$codeOut)
                ->setContactThrough('plain person with plain phone')
                ->setComments('plain operator comment');
            $manager->persist($monitoringOut);
        }

        for ($i = 1; $i <= 15; $i++) {
            $accidentCase = $manager->getRepository('TruckBundle:AccidentCase')->find(\mt_rand(1, 35));
            $accidentCase->setProgressColor(AccidentCase::$progressColorGreen);

            $monitoringStrr = new Monitoring();
            $monitoringStrr->setAccidentCase($accidentCase)
                ->setOperator('operator name')
                ->setCode(Monitoring::$codeStrr)
                ->setContactThrough('plain person with plain phone')
                ->setComments('plain operator comment');
            $manager->persist($monitoringStrr);
        }

        for ($i = 1; $i <= 5; $i++) {
            $accidentCase = $manager->getRepository('TruckBundle:AccidentCase')->find(\mt_rand(5, 20));
            $accidentCase->setProgressColor(AccidentCase::$progressColorOrange);

            $monitoringEta = new Monitoring();
            $monitoringEta->setAccidentCase($accidentCase)
                ->setOperator('operator name')
                ->setCode(Monitoring::$codeEta)
                ->setContactThrough('plain person with plain phone')
                ->setComments('plain operator comment')
                ->setTimeSet(new \DateTime('now + 5 minutes'));
            $manager->persist($monitoringEta);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            AccidentCaseFixtures::class
        ];
    }
}
