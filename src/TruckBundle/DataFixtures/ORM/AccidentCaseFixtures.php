<?php

declare(strict_types=1);

namespace TruckBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use TruckBundle\Entity\AccidentCase;
use TruckBundle\Entity\Monitoring;

class AccidentCaseFixtures extends Fixture implements DependentFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 40; $i++) {
            $vehicle = $manager->getRepository('TruckBundle:Vehicle')->find(\mt_rand(1, 2000));
            $date = new \DateTime('now - ' . \mt_rand(1, 2000) . 'minutes');

            $activeAccidentCase = new AccidentCase();
            $activeAccidentCase->setComment('case comment' . $i);
            $activeAccidentCase->setDamageDescription('damage description' . $i);
            $activeAccidentCase->setDriverContact('contact to driver' . $i);
            $activeAccidentCase->setLocation('vehicle location ' . $i);
            $activeAccidentCase->setTimeStart($date);
            $activeAccidentCase->setVehicle($vehicle);
            $manager->persist($activeAccidentCase);

            $monitoringStart = new Monitoring();
            $monitoringStart->setAccidentCase($activeAccidentCase)
                ->setCode(Monitoring::$codeStart)
                ->setOperator('operatorName')
                ->setComments($activeAccidentCase->getComment())
                ->setContactThrough($activeAccidentCase->getDriverContact())
                ->setTimeSave($date);
            $manager->persist($monitoringStart);
        }

        for ($i = 1; $i <= 3000; $i++) {
            $vehicle = $manager->getRepository('TruckBundle:Vehicle')->find(\mt_rand(1, 2000));
            $date = new \DateTime('now - ' . \mt_rand(1500, 5000) . 'minutes');

            $inactiveAccidentCase = new AccidentCase();
            $inactiveAccidentCase->setComment('case comment' . $i);
            $inactiveAccidentCase->setDamageDescription('damage description' . $i);
            $inactiveAccidentCase->setDriverContact('contact to driver' . $i);
            $inactiveAccidentCase->setLocation('vehicle location ' . $i);
            $inactiveAccidentCase->setStatus('inactive');
            $inactiveAccidentCase->setProgressColor(AccidentCase::$progressColorLightGrey);
            $inactiveAccidentCase->setTimeStart($date);
            $inactiveAccidentCase->setVehicle($vehicle);
            $manager->persist($inactiveAccidentCase);

            $monitoringStart = new Monitoring();
            $monitoringStart->setAccidentCase($inactiveAccidentCase)
                ->setCode(Monitoring::$codeStart)
                ->setOperator('plainName')
                ->setComments($inactiveAccidentCase->getComment())
                ->setContactThrough($inactiveAccidentCase->getDriverContact())
                ->setTimeSave($date);
            $manager->persist($monitoringStart);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            VehicleFixtures::class
        ];
    }
}
