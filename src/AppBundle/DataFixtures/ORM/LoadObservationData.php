<?php

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Observation;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadObservationData implements FixtureInterface, ContainerAwareInterface
{
    private $container;

    public function load(ObjectManager $manager)
    {
        //On récupère un oiseau
        $userManager = $this->container->get('fos_user.user_manager');
        $user = $userManager->createUser();
        $user->setUsername("fakeuser");
        $user->setEmail("fakeuser@fake.com");
        $user->setPlainPassword("0000");
        $user->setEnabled(1);
        $userManager->updateUser($user, true);

        $bird = $manager->getRepository('AppBundle:NaoAves')->find(5);
        $lat = 46.990896;
        $lng = 3.162845;
        for ($i = 0; $i<100; $i++){
            $latRandom = rand(0,1) ? $lat + (rand(1,9) / (rand(1,2)*10)) : $lat + (rand(1,9) / (rand(1,2)*10));
            $lngRandom = rand(0,1) ? $lng + (rand(1,9) / (rand(1,2)*10)) : $lng + (rand(1,9) / (rand(1,2)*10));
            $observation = new Observation();
            $observation->setLat($latRandom);
            $observation->setLng($lngRandom);
            $observation->setBird($bird);
            $observation->setDate(new \DateTime());
            $observation->setStatut(Observation::STATUS_ACCEPTED);
            $observation->setComment("Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium adipisci assumenda laborum nesciunt quas, recusandae soluta. Ad enim et fugiat harum hic magni maxime, nemo nulla odio officia quas soluta.");
            $observation->setUser($user);

            $manager->persist($observation);
        }

        $manager->flush();
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}