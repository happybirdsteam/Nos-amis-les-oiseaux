<?php

namespace AppBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Observation;

class LoadObservationData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        //On récupère un oiseau
        $bird = $manager->getRepository('AppBundle:NaoAves')->find(5);
        $lat = 46.990896;
        $lng = 3.162845;
        for ($i = 0; $i<100; $i++){
            $latRandom = $lat + (rand(1,9) / (rand(1,2)*10));
            $lngRandom = $lng + (rand(1,9) / (rand(1,2)*10));
            $observation = new Observation();
            $observation->setLat($latRandom);
            $observation->setLng($lngRandom);
            $observation->setBird($bird);
            $observation->setDate(new \DateTime());

            $manager->persist($observation);
        }

        $manager->flush();
    }
}