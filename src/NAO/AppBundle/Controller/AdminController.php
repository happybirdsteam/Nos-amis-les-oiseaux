<?php

namespace NAO\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use NAO\UserBundle\Entity\User;

class AdminController extends Controller
{
    public function indexAction()
    {
        return $this->render('NAOAppBundle:Admin:index.html.twig');
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

        return $this->render('NAOAppBundle:Admin:userManagement.html.twig', array(
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
}
