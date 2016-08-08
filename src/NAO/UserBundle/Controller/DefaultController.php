<?php

namespace NAO\UserBundle\Controller;

use NAO\UserBundle\Entity\Observation;
use NAO\UserBundle\Form\ObservationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('NAOUserBundle:Home:index.html.twig');
    }
}
