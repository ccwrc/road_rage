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
        $users = $this->getDoctrine()->getRepository("TruckBundle:User")->findAll();

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

            $userManager = $this->container->get('fos_user.user_manager');
            $foundUser = $userManager->findUserByUsernameOrEmail($user->getUsername());
            return $this->render('TruckBundle:User:show_user.html.twig', [
                        "user" => $foundUser
            ]);
        }
        return $this->render('TruckBundle:User:find_user.html.twig', [
                    "form" => $form->createView()
        ]);
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
        // super admin only
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
