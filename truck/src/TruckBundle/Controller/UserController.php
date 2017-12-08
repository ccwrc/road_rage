<?php

namespace TruckBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

// use TruckBundle\Entity\User;

/**
 * @Route("/user")
 * @Security("has_role('ROLE_ADMIN')")
 */
class UserController extends Controller {

    /**
     * @Route("/{userId}/showUser", requirements={"userId"="\d+"})
     */
    public function showUserAction($userId) {
        $this->throwExceptionIfUserIdIsWrong($userId);
        $user = $this->getDoctrine()->getRepository("TruckBundle:User")->find($userId);

        return $this->render('TruckBundle:User:show_user.html.twig', array(
                    "user" => $user
        ));
    }

    /**
     * @Route("/showAllUsers")
     */
    public function showAllUsersAction() {
        return $this->render('TruckBundle:User:show_all_users.html.twig', array(
                        // ...
        ));
    }

    /**
     * @Route("/findUser")
     */
    public function findUserAction() {
        return $this->render('TruckBundle:User:find_user.html.twig', array(
                        // ...
        ));
    }

    /**
     * @Route("/addRoleToUser")
     */
    public function addRoleToUserAction() {
        return $this->render('TruckBundle:User:add_role_to_user.html.twig', array(
                        // ...
        ));
    }

    /**
     * @Route("/removeRoleFromUser")
     */
    public function removeRoleFromUserAction() {
        return $this->render('TruckBundle:User:remove_role_from_user.html.twig', array(
                        // ...
        ));
    }

    /**
     * @Route("/deleteUser")
     */
    public function deleteUserAction() {
        return $this->render('TruckBundle:User:delete_user.html.twig', array(
                        // ...
        ));
    }
    
    protected function throwExceptionIfUserIdIsWrong($userId) {
        $user = $this->getDoctrine()->getRepository("TruckBundle:User")->find($userId);
        if ($user === null) {
            throw $this->createNotFoundException("Wrong user ID");
        }
    }

}
