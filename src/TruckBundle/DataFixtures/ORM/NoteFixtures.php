<?php

namespace TruckBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use TruckBundle\Entity\Note;

class NoteFixtures extends Fixture implements DependentFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 30; $i++) {
            $operator = $manager->getRepository('TruckBundle:User')->find(\mt_rand(3, 6));

            $privateNotePast = new Note();
            $privateNotePast->setUserId($operator->getId())
                ->setUsername($operator->getUsername())
                ->setContent('private note' . $i)
                ->setStatus(Note::$statusPrivate)
                ->setTimePublication(new \DateTime('now - 2 days'));
            $manager->persist($privateNotePast);
        }

        for ($i = 1; $i <= 10; $i++) {
            $operator = $manager->getRepository('TruckBundle:User')->find(\mt_rand(3, 6));

            $privateNotePresent = new Note();
            $privateNotePresent->setUserId($operator->getId())
                ->setUsername($operator->getUsername())
                ->setContent('private note' . $i)
                ->setStatus(Note::$statusPrivate)
                ->setTimePublication(new \DateTime());
            $manager->persist($privateNotePresent);
        }

        for ($i = 1; $i <= 11; $i++) {
            $operator = $manager->getRepository('TruckBundle:User')->find(\mt_rand(3, 6));

            $privateNoteFuture = new Note();
            $privateNoteFuture->setUserId($operator->getId())
                ->setUsername($operator->getUsername())
                ->setContent('private note' . $i)
                ->setStatus(Note::$statusPrivate)
                ->setTimePublication(new \DateTime('now + 1 week'));
            $manager->persist($privateNoteFuture);
        }

        for ($i = 1; $i <= 20; $i++) {
            $operator = $manager->getRepository('TruckBundle:User')->find(\mt_rand(3, 6));

            $publicNotePast = new Note();
            $publicNotePast->setUserId($operator->getId())
                ->setUsername($operator->getUsername())
                ->setContent('public note' . $i)
                ->setStatus(Note::$statusPublic)
                ->setTimePublication(new \DateTime('now - 2 days'));
            $manager->persist($publicNotePast);
        }

        for ($i = 1; $i <= 3; $i++) {
            $operator = $manager->getRepository('TruckBundle:User')->find(\mt_rand(3, 6));

            $publicNotePresent = new Note();
            $publicNotePresent->setUserId($operator->getId())
                ->setUsername($operator->getUsername())
                ->setContent('public note' . $i)
                ->setStatus(Note::$statusPublic)
                ->setTimePublication(new \DateTime());
            $manager->persist($publicNotePresent);
        }

        for ($i = 1; $i <= 3; $i++) {
            $operator = $manager->getRepository('TruckBundle:User')->find(\mt_rand(3, 6));

            $publicNoteFuture = new Note();
            $publicNoteFuture->setUserId($operator->getId())
                ->setUsername($operator->getUsername())
                ->setContent('public note' . $i)
                ->setStatus(Note::$statusPublic)
                ->setTimePublication(new \DateTime('now + 1 month'));
            $manager->persist($publicNoteFuture);
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
