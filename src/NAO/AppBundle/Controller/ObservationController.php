<?php

namespace NAO\AppBundle\Controller;

use NAO\UserBundle\Entity\Observation;
use NAO\UserBundle\Form\ObservationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ObservationController extends Controller
{
    public function observationAction()
    {
        $observation = new Observation();

        $form = $this->get('form.factory')->create(ObservationType::class, $observation);

        return $this->render('NAOAppBundle:Observation:index.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
