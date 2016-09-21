<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Observation;
use AppBundle\Form\ObservationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class HomeController extends Controller
{
    public function indexAction(Request $request)
    {
        $observation = new Observation();
        $em = $this->getDoctrine()->getManager();

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

            // Check if bird is != null
            $getBird = $form->get('bird')->getData();
            $AvesBird = $em->getRepository('AppBundle:NaoAves')->findBy(array('lbNom' => $getBird));
            if (null === $AvesBird) {
                throw new Exception("Cet oiseau n'existe pas !");
            }

            // Update the 'brochure' property to store the PDF file name
            // instead of its contents
            $observation->setImage($fileName);

            // Add day of the observation
            $observation->setDate(new \DateTime('now'));

            // Add user
            $user = $this->getUser();
            $observation->setUser($user);

            // ... persist the $product variable or any other work
            $em->persist($observation);
            $em->flush();

            $this->addFlash('info', 'Votre observation a été enregistrée, elle est en attente de validation.');

            return $this->redirectToRoute('nao_app_homepage');
        }

        return $this->render('AppBundle:Home:index.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function ajaxBirdAction(Request $request)
    {
        if($request->isXmlHttpRequest())
        {
        /*
            $term = $request->get('motcle');
            $array= $this->getDoctrine()
                ->getManager()
                ->getRepository('AppBundle:NaoAves')
                ->findBird($term);
	   */
	   $array= $this->getDoctrine()
                ->getManager()
                ->getRepository('AppBundle:NaoAves')
                ->getResult();
            $response = new Response(json_encode($array));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }
    }
    
    
    public function testAction()
   {
        return $this->render('AppBundle:Home:viewObservation.html.twig');
    }

    public function getMarkersAction($latlng)
    {
        $array = explode(',', $latlng);
        $result = $this->getDoctrine()
           ->getManager()
           ->getRepository('AppBundle:Observation')
           ->getMarkersBetween($array);

       return new JsonResponse($result);
   }
    
    
    
    public function viewObservationAction(){
    $theBird = "Polystica stelleri";
    
    $DB_response = $this->getDoctrine()->getManager()
    			->getRepository('AppBundle:Observation')->findBy(array("bird"=> $theBird));
    			
   // var_dump($DB_response);
    
    	 return $this->render('AppBundle:Home:viewAllObservations.html.twig', 
    	 					  array("birds" => $DB_response, "statut" =>'accepted') 
    	 					);
    }
    
    public function viewMyObservationsAction( User $user ){
    
    	$query = $this->getDoctrine()
    		->getManager()
    		->getRepository('AppBundle:Observation')
    		->findBy( array("user_id" => $user) );
    	return $this->render('AppBundle:Home:viewMyObservations.html.twig', array( "observations" => $query ) );
    
    }
    
    public function ajaxGetObservationsByBirdAction( Request $request){
    	if($request->isXmlHttpRequest()){
    	
    		$theBird = $request->get('bird');
    		
    		if($theBird){
    			$theBird = str_replace("%20", " ", $theBird);
    			$DB_response = $this->getDoctrine()->getManager()
    			->getRepository('AppBundle:Observation')->findBy(array("bird" => "$theBird"));
    			$jsonContent = new JsonResponse();
    			$jsonContent->setData( $DB_response);
    			

    			$response = new Response( $jsonContent );
    			$response ->headers ->set('Content-Type', 'application/json');
            	return $response;
    		}
    	
    	}
    
    }
}

