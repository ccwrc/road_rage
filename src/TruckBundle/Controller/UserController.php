<?php

namespace TruckBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

use TruckBundle\Entity\User;
use TruckBundle\Form\User\UserFindType;

/**
 * @Route("/user")
 * @Security("has_role('ROLE_ADMIN')")
 */
class UserController extends Controller {

    // role ROLE_SUPER_ADMIN is protected, preferred to be added/removal only in console
    // role ROLE_USER is default
    private static $permittedRoles = [
        "ROLE_DEALER",
        "ROLE_OPERATOR",
        "ROLE_CONTROL",
        "ROLE_ADMIN"
    ];

    /**
     * @Route("/{userId}/showUser", requirements={"userId"="\d+"})
     */
    public function showUserAction($userId) {
        $user = $this->throwExceptionIfUserIdIsWrongOrGetUserBy($userId);

        return $this->render('TruckBundle:User:show_user.html.twig', array(
                    "user" => $user,
                    "permittedRoles" => self::$permittedRoles
        ));
    }

    /**
     * @Route("/showAllUsers")
     */
    public function showAllUsersAction() {
        $users = $this->getDoctrine()->getRepository("TruckBundle:User")->findAll();
          // TODO pagination
        return $this->render('TruckBundle:User:show_all_users.html.twig', array(
                    "users" => $users
        ));
    }

    /**
     * @Route("/findUser")
     */
    public function findUserAction(Request $req) {
        $user = new User();
        $form = $this->createForm(UserFindType::class, $user);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
              // TODO create own repo (find by piece of name/email)
            $userManager = $this->container->get('fos_user.user_manager');
            $foundUser = $userManager->findUserByUsernameOrEmail($user->getUsername());
            return $this->render('TruckBundle:User:show_user.html.twig', [
                        "user" => $foundUser,
                        "permittedRoles" => self::$permittedRoles
            ]);
        }
        return $this->render('TruckBundle:User:find_user.html.twig', [
                    "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/{userId}/{role}/addRoleToUser", 
     * requirements={"userId"="\d+", "role"="\w{0,20}"})
     */
    public function addRoleToUserAction($userId, $role) {
        $user = $this->throwExceptionIfUserIdIsWrongOrGetUserBy($userId);

        if (in_array($role, self::$permittedRoles)) {
            $user->addRole($role);
            $em = $this->getDoctrine()->getManager();
            $em->flush();
        }

        return $this->redirectToRoute('truck_user_showuser', array(
                    "userId" => $userId
        ));
    }

    /**
     * @Route("/{userId}/{role}/removeRoleFromUser", 
     * requirements={"userId"="\d+", "role"="\w{0,20}"})
     */
    public function removeRoleFromUserAction($userId, $role) {
        $user = $this->throwExceptionIfUserIdIsWrongOrGetUserBy($userId);

        if (in_array($role, self::$permittedRoles)) {
            $user->removeRole($role);
            $em = $this->getDoctrine()->getManager();
            $em->flush();
        }

        return $this->redirectToRoute('truck_user_showuser', array(
                    "userId" => $userId
        ));
    }

    /**
     * @Route("/{userId}/deleteUser", requirements={"userId"="\d+"})
     */
    public function deleteUserAction($userId) {
        $this->denyAccessUnlessGranted("ROLE_SUPER_ADMIN", null, "Access denied.");
        $user = $this->throwExceptionIfUserIdIsWrongOrGetUserBy($userId);
        $message = "You can not delete this user.";

        $userName = $user->getUsername();
        $loggedUser = $this->getUser();
        if ($user != $loggedUser) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
            $message = "User \"" . $userName . "\" removed";
        }

        return $this->render('TruckBundle:User:delete_user.html.twig', array(
                    "message" => $message
        ));
    }

    /**
     * @Route("/{userId}/enableDisableUser", requirements={"userId"="\d+"})
     */
    public function enableDisableUserAction($userId) {
        $user = $this->throwExceptionIfUserIdIsWrongOrGetUserBy($userId);
        $em = $this->getDoctrine()->getManager();

        if ($user->isEnabled() === false) {
            $user->setEnabled(true);
            $em->flush();
        } else {
            $user->setEnabled(false);
            $em->flush();
        }

        return $this->render('TruckBundle:User:show_user.html.twig', array(
                    "user" => $user,
                    "permittedRoles" => self::$permittedRoles
        ));
    }
    
    private function throwExceptionIfUserIdIsWrongOrGetUserBy($userId) {
        $user = $this->getDoctrine()->getRepository("TruckBundle:User")->find($userId);
        if ($user === null) {
            throw $this->createNotFoundException("Wrong user ID");
        }
        return $user;
    }    

}
