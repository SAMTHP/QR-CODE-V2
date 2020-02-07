<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AuthenticationFrontController extends AbstractController
{
    /**
     * @Route("/loginApp", name="authentication_login", methods={"GET"})
     */
    public function index(UserRepository $userRepository, Request $request)
    {
        // Get data with request
        $data = $request->getContent();

        // Decode content of request
        $decodeData = \json_decode($data);
        
        // Get User by email from request
        $user = $userRepository->findOneByEmail($decodeData->email);

        // Test if login is valid
        if($user){
            if($decodeData->password == $user->getPassword()) {
                return new JsonResponse("success", Response::HTTP_OK, [], true);
            } else {
                return new JsonResponse("failed", Response::HTTP_OK, [], true);
            }
        } else {
            return new JsonResponse("failede", Response::HTTP_OK, [], true);
        }
    }
}
