<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Security\UserProvider;
use UserBundle\Entity\User;
use AppBundle\Entity\Observations;


class AdminController extends Controller
{

//DRY violation ( link to enum ) must inject the enum list directly minus pending
 public $possibleStatus = ["pending" =>"en attente", "accepted" => "accepter", "rejected" => "rejeter"];
 
    public function indexAction()
    {
        return $this->render('AppBundle:Admin:index.html.twig');
    }

    public function userManagementAction()
    {
        $adminList = array();
        $naturalistList = array();
        $observerList = array();

        $userManager = $this->get('fos_user.user_manager');
        $userList = $userManager->findUsers();

        foreach ($userList as $user) {
            if ($user->hasRole('ROLE_ADMIN')) {
                array_push($adminList, $user);
            } elseif ($user->hasRole('ROLE_NATURALIST')) {
                array_push($naturalistList, $user);
            } elseif ($user->hasRole('ROLE_OBSERVER')) {
                array_push($observerList, $user);
            }
        }

        return $this->render('AppBundle:Admin:userManagement.html.twig', array(
            'adminList' => $adminList,
            'naturalistList' => $naturalistList,
            'observerList' => $observerList
        ));
    }

    public function deleteAction(User $user)
    {
        $userManager = $this->get('fos_user.user_manager');
        $userManager->deleteUser($user);

        $this->addFlash('info', 'L\'utilisateur ' . $user->getUsername() . ' a été supprimé.');

        return $this->redirectToRoute('nao_app_user_management');
    }

    public function promoteAction(User $user)
    {
        $userManager = $this->get('fos_user.user_manager');

        if ($user->hasRole('ROLE_ADMIN')) {
            $this->addFlash('info', 'L\'utilisateur ' . $user->getUsername() . ' est déjà au grade maximum.');
        } elseif ($user->hasRole('ROLE_NATURALIST')) {
            $user->removeRole('ROLE_NATURALIST');
            $user->addRole('ROLE_ADMIN');
            $userManager->updateUser($user);
            $this->addFlash('info', 'L\'utilisateur ' . $user->getUsername() . ' est promu admin.');
        } elseif ($user->hasRole('ROLE_OBSERVER')) {
            $user->removeRole('ROLE_OBSERVER');
            $user->addRole('ROLE_NATURALIST');
            $userManager->updateUser($user);
            $this->addFlash('info', 'L\'utilisateur ' . $user->getUsername() . ' est promu naturaliste.');
        } else {
            $this->addFlash('info', 'L\'utilisateur ' . $user->getUsername() . ' n\'a pas un rôle valide.');
        }

        return $this->redirectToRoute('nao_app_user_management');
    }

    public function demoteAction(User $user)
    {
        $userManager = $this->get('fos_user.user_manager');

        if ($user->hasRole('ROLE_ADMIN')) {
            $user->removeRole('ROLE_ADMIN');
            $user->addRole('ROLE_NATURALIST');
            $userManager->updateUser($user);
            $this->addFlash('info', 'L\'utilisateur ' . $user->getUsername() . ' est rétrogradé naturaliste.');
        } elseif ($user->hasRole('ROLE_NATURALIST')) {
            $user->removeRole('ROLE_NATURALIST');
            $user->addRole('ROLE_OBSERVER');
            $userManager->updateUser($user);
            $this->addFlash('info', 'L\'utilisateur ' . $user->getUsername() . ' est rétrogradé observateur.');
        } elseif ($user->hasRole('ROLE_OBSERVER')) {
            $this->addFlash('info', 'L\'utilisateur ' . $user->getUsername() . ' est déjà au grade minimum.');
        } else {
            $this->addFlash('info', 'L\'utilisateur ' . $user->getUsername() . ' n\'a pas un rôle valide.');
        }

        return $this->redirectToRoute('nao_app_user_management');
    }
    
    
    
    public function confirmObservationAction(){
    
    	if( $this->isGranted('ROLE_ADMIN') || $this->isGranted('ROLE_NATURALIST')){
    		
    		
    		
    			//DRY violation ( link to enum ) must inject the enum list directly minus pending
    		 
    			$protocol = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
    			$server = $protocol . $_SERVER['SERVER_NAME'];
				$img = $this->getParameter('web_img_directory');
    			$contributionsList = $this->getDoctrine()
                	->getManager()
                	->getRepository('AppBundle:Observation')
                	->findBy( array("statut" => "pending") );
                
                //var_dump($contributionsList);
        		return $this->render(
        			'AppBundle:Admin:observationManagement.html.twig',
        			array('observations' => $contributionsList, 
            	  		'server' => $server, 
            	  		'folder'=> $img,
            	  		'option_value' => $this->possibleStatus
            		)
        		);
    		} 
	}
	
	
	public function alterStatutAction(Request $request){
	
		if($request->isXmlHttpRequest() && ( $this->isGranted('ROLE_ADMIN') || $this->isGranted('ROLE_NATURALIST') ) ){
		//alter the Observation and send confirmation
				$id = $request->request->get('id');
				$statut = (string)$request->request->get('statut');
				$em = $this->getDoctrine()->getManager();
    			$observation = $em->getRepository('AppBundle:Observation')->find($id);
    			if (!$observation) {
    				throw $this->createNotFoundException(
            		'No Observaton found for id '.$id
        			);
    			}
    			if(!array_key_exists($statut, $this->possibleStatus) ) {
    				
    				throw $this->createNotFoundException('statut inconnu' . $statut );
    			}
    			$observation->setStatut($statut);
    			$em->flush();
				
				return new response("id :". $id ."a été mise à jour en :" . $statut);
    	} else {
    	return new response( "false or not_granted");
    	}
	}
	
	
	public function viewObservationsAction(Request $request){
	
	$statut = $request->query->get('statut') === null ? 'accepted' : $request->query->get('statut') ;
	$byAuthor = $request->query->get('userID') === null ? '*' : $request->query->get('userID') ;
	$protocol = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
    			$server = $protocol . $_SERVER['SERVER_NAME'];
				$img = $this->getParameter('web_img_directory');
	//
	$contributionsList;		
	if ($byAuthor !="*") { 
		$contributionsList = $this->getDoctrine()->getManager()-> getRepository('AppBundle:Observation') 
	->findBy( array("statut" => $statut, "user" => $byAuthor) ); 
	} else {
	
	$contributionsList = $this->getDoctrine()
                	->getManager()
                	->getRepository('AppBundle:Observation')
                	->findBy( array("statut" => $statut) ); 
	}
	//
	return $this->render(
		'AppBundle:Admin:observationViewer.html.twig',
		 array( 
			'observations' => $contributionsList,
			'possibleStatus' =>$this->possibleStatus,
			'server' => $server, 
            'folder'=> $img,
		)
			
	);
	
	}
	
}