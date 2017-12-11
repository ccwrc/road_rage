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
    
    // role ROLE_SUPER_ADMIN is protected
    // preferred to be added/removal only in console
    private static $permittedRoles = [
        "ROLE_USER",
        "ROLE_DEALER",
        "ROLE_OPERATOR",
        "ROLE_CONTROL",
        "ROLE_ADMIN"
    ];

    /**
     * @Route("/{userId}/showUser", requirements={"userId"="\d+"})
     */
    public function showUserAction($userId) {
        $this->throwExceptionIfUserIdIsWrong($userId);
        $user = $this->getDoctrine()->getRepository("TruckBundle:User")->find($userId);

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
     * requirements={"userId"="\d+", "role"="\w{0,15}"})
     */
    public function addRoleToUserAction($userId, $role) {
        $this->throwExceptionIfUserIdIsWrong($userId);

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository("TruckBundle:User")->find($userId);
        if (in_array($role, self::$permittedRoles)) {
            $user->addRole($role);
            $em->flush();
        }

        return $this->redirectToRoute('truck_user_showuser', array(
                    "userId" => $userId
        ));
    }    

    /**
     * @Route("/{userId}/{role}/removeRoleFromUser", 
     * requirements={"userId"="\d+", "role"="\w{0,15}"})
     */
    public function removeRoleFromUserAction($userId, $role) {
        $this->throwExceptionIfUserIdIsWrong($userId);

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository("TruckBundle:User")->find($userId);
        if (in_array($role, self::$permittedRoles)) {
            $user->removeRole($role);
            $em->flush();
        }

        return $this->redirectToRoute('truck_user_showuser', array(
                    "userId" => $userId
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
