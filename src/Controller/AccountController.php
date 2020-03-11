<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AccountController extends AbstractController
{
    /**
     * Allow to login
     * 
     * @Route("/login", name="account_login")
     * 
     * @param AuthenticationUtils $utils
     * @author Samir Founou
     * 
     * @return Response
     */
    public function login(AuthenticationUtils $utils)
    {
        $error = $utils->getLastAuthenticationError();
        $username = $utils->getLastUsername();

        return $this->render('account/login.html.twig', [
            'hasError' => $error !== null,
            'username' => $username
        ]);
    }

    /**
     * Allow to logout
     *
     * @Route("/logout", name="account_logout")
     * @author Samir Founou
     * 
     * @return void
     */
    public function logout()
    {

    }
}
