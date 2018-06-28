<?php

declare(strict_types=1);

namespace TruckBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use TruckBundle\Entity\User;
use TruckBundle\Form\User\UserFindType;

/**
 * @Route("/user")
 * @Security("has_role('ROLE_ADMIN')")
 */
final class UserController extends Controller
{

    /* role ROLE_SUPER_ADMIN is protected, preferred to be added/removal only in console
       role ROLE_USER is default */
    private static $permittedRolesForAddOrRemove = [
        'ROLE_DEALER',
        'ROLE_OPERATOR',
        'ROLE_CONTROL',
        'ROLE_ADMIN'
    ];

    /**
     * @Route("/{userId}/showUser", requirements={"userId"="\d+"})
     */
    public function showUserAction(int $userId): Response
    {
        $user = $this->throwExceptionIfUserIdIsWrongOrGetUserBy($userId);

        return $this->render('TruckBundle:User:show_user.html.twig', array(
            'user' => $user,
            'permittedRoles' => self::$permittedRolesForAddOrRemove
        ));
    }

    /**
     * @Route("/showAllUsers")
     */
    public function showAllUsersAction(Request $req): Response
    {
        $usersQuery = $this->getDoctrine()->getRepository('TruckBundle:User')->findAll();

        $paginator = $this->get('knp_paginator');
        $users = $paginator->paginate(
            $usersQuery,
            $req->query->get('page', 1), 15);

        return $this->render('TruckBundle:User:show_all_users.html.twig', array(
            'users' => $users
        ));
    }

    /**
     * @Route("/findUser")
     */
    public function findUserAction(Request $req): Response
    {
        // TODO find user by piece of name/email (repo ready)
        // TODO create custom form
        $user = new User();
        $form = $this->createForm(UserFindType::class, $user);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $userManager = $this->container->get('fos_user.user_manager');
            $foundUser = $userManager->findUserByUsernameOrEmail($user->getUsername());

            return $this->render('TruckBundle:User:show_user.html.twig', [
                'user' => $foundUser,
                'permittedRoles' => self::$permittedRolesForAddOrRemove
            ]);
        }
        return $this->render('TruckBundle:User:find_user.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{userId}/{role}/addRoleToUser",
     * requirements={"userId"="\d+", "role"="\w{0,20}"})
     */
    public function addRoleToUserAction(int $userId, string $role): Response
    {
        $user = $this->throwExceptionIfUserIdIsWrongOrGetUserBy($userId);

        if (\in_array($role, self::$permittedRolesForAddOrRemove)) {
            $user->addRole($role);
            $this->getDoctrine()->getManager()->flush();
        }

        return $this->redirectToRoute('truck_user_showuser', array(
            'userId' => $userId
        ));
    }

    /**
     * @Route("/{userId}/{role}/removeRoleFromUser",
     * requirements={"userId"="\d+", "role"="\w{0,20}"})
     */
    public function removeRoleFromUserAction(int $userId, string $role): Response
    {
        $user = $this->throwExceptionIfUserIdIsWrongOrGetUserBy($userId);

        if (\in_array($role, self::$permittedRolesForAddOrRemove)) {
            $user->removeRole($role);
            $this->getDoctrine()->getManager()->flush();
        }

        return $this->redirectToRoute('truck_user_showuser', array(
            'userId' => $userId
        ));
    }

    /**
     * @Route("/{userId}/deleteUser", requirements={"userId"="\d+"})
     */
    public function deleteUserAction(int $userId): Response
    {
        $this->denyAccessUnlessGranted('ROLE_SUPER_ADMIN', null, 'Access denied.');
        $user = $this->throwExceptionIfUserIdIsWrongOrGetUserBy($userId);
        $message = 'You can not delete this user.';

        $username = $user->getUsername();
        $loggedUser = $this->getUser();
        if ($user != $loggedUser) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
            $message = 'User "' . $username . '" removed';
        }

        return $this->render('TruckBundle:User:delete_user.html.twig', array(
            'message' => $message
        ));
    }

    /**
     * @Route("/{userId}/enableDisableUser", requirements={"userId"="\d+"})
     */
    public function enableDisableUserAction(int $userId): Response
    {
        $user = $this->throwExceptionIfUserIdIsWrongOrGetUserBy($userId);
        $loggedUser = $this->getUser();

        if ($user === $loggedUser) {
            return $this->render('TruckBundle:User:delete_user.html.twig', array(
                'message' => 'You can not turn on/off your own account.'
            ));
        }

        $em = $this->getDoctrine()->getManager();
        if ($user->isEnabled() === false) {
            $user->setEnabled(true);
        } else {
            $user->setEnabled(false);
        }
        $em->flush();

        return $this->render('TruckBundle:User:show_user.html.twig', array(
            'user' => $user,
            'permittedRoles' => self::$permittedRolesForAddOrRemove
        ));
    }

    /**
     * @param int $userId
     * @throws NotFoundHttpException
     * @return User
     */
    private function throwExceptionIfUserIdIsWrongOrGetUserBy(int $userId): User
    {
        $user = $this->getDoctrine()->getRepository('TruckBundle:User')->find($userId);
        if ($user === null) {
            throw $this->createNotFoundException('Wrong user ID');
        }
        return $user;
    }
}
