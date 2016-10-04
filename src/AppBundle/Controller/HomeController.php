<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Observation;
use UserBundle\Entity\User;
use AppBundle\Form\ObservationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Eventviva\ImageResize;

class HomeController extends Controller
{

//DRY violation ( link to enum ) must inject the enum list directly minus pending
 public $possibleStatus = ["pending" =>"en attente", "accepted" => "accepter", "rejected" => "rejeter"];
 
 
    public function indexAction(Request $request)
    {
        if( !$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY') ) {
            return $this->render('AppBundle:Home:index.html.twig');
        }


        $observation = new Observation();
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(ObservationType::class, $observation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $file stores the uploaded PDF file
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $observation->getImage();

			if( $file){
            	// Generate a unique name for the file before saving it
            	$prefix = md5(uniqid());
            	$imageThumb = new ImageResize( $file);
				$imageThumb->resizeToWidth(150);
				
            	$fileName = $prefix .'.'.$file->guessExtension();
            	$thumb_to_save = $this->getParameter('image_directory') . "/thumb_" . $fileName;
				// Move the file to the directory where brochures are stored
            	$file->move(
                	$this->getParameter('image_directory'),
                	$fileName
            	);
            	
            	$imageThumb->save( $thumb_to_save);
            	// Update the 'image' property to store the jpeg file name
            	// instead of its contents
            	$observation->setImage($fileName);
            }


            // Check if bird is != null
            $getBird = $form->get('bird')->getData();
            $AvesBird = $em->getRepository('AppBundle:NaoAves')->findBy(array('lbNom' => $getBird));

            $observation->setBird($AvesBird[0]);

            
            // Add day of the observation
            $observation->setDate(new \DateTime('now'));
            $observation->setStatut("pending");

            // Add user
            $user = $this->getUser();
            $observation->setUser($user);

            // ... persist the $product variable or any other work
            $em->persist($observation);
            $em->flush();

            $this->addFlash('info', 'Votre observation a été enregistrée, elle est en attente de validation.');

            return $this->redirectToRoute('nao_app_homepage');
        }
        

        return $this->render('AppBundle:Home:createObservation.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function ajaxBirdAction(Request $request)
    {
        if($request->isXmlHttpRequest())
        {
            $term = $request->get('motcle');
            $array= $this->getDoctrine()
                ->getManager()
                ->getRepository('AppBundle:NaoAves')
                ->findBird($term);
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
    
    	//DRY violation ( link to enum ) must inject the enum list directly minus pending
    		 
    			$protocol = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
    			$server = $protocol . $_SERVER['SERVER_NAME'];
				$img = $this->getParameter('web_img_directory');
    
    	$query = $this->getDoctrine()
    		->getManager()
    		->getRepository('AppBundle:Observation')
    		->findBy( array("user" => $user) );
    	return $this->render('AppBundle:Home:viewMyObservations.html.twig', 
    						array( "observations" => $query,
    								'server' => $server, 
            	  					'folder'=> $img,
            	  					'option_value' => $this->possibleStatus
            	  			) );
    
    }
    
    public function ajaxGetObservationsByBirdAction( Request $request){
    	if($request->isXmlHttpRequest()){
    		$theBird = $request->get('bird');
    		
    			if($theBird){
    				$theBird = str_replace("%20", " ", $theBird);
    				//A reel name for test
    				//$theBird = "Phoeniconaias minor";
    				
    				$DB_response = $this->getDoctrine()->getManager()
    				->getRepository('AppBundle:Observation')->getObservationWithRelatedAves($theBird, "accepted");
    				$array = [];
    				$response = new JsonResponse( $DB_response );
            		return $response;
    			}
    	}
    
	}
	
}

