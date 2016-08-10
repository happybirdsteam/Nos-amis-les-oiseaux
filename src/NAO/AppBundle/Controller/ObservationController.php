<?php

namespace NAO\AppBundle\Controller;

use NAO\UserBundle\Entity\Observation;
use NAO\UserBundle\Form\ObservationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ObservationController extends Controller
{
    public function observationAction(Request $request)
    {
        $observation = new Observation();

        $form = $this->createForm(ObservationType::class, $observation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $file stores the uploaded PDF file
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $observation->getImage();

            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            // Move the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('image_directory'),
                $fileName
            );

            // Update the 'brochure' property to store the PDF file name
            // instead of its contents
            $observation->setImage($fileName);

            //On ajoute la date du jour à l'observation
            $observation->setDate(new \DateTime('now'));

            // ... persist the $product variable or any other work
            $em = $this->getDoctrine()->getManager();
            $em->persist($observation);
            $em->flush();

        }

        return $this->render('NAOAppBundle:Observation:index.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
