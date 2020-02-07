<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AuthenticationFrontController extends AbstractController
{
    /**
     * @Route("/authentication", name="authentication_login", methods={"POST"})
     */
    public function index(UserRepository $userRepository, ValidatorInterface $validatorInterface, EntityManagerInterface $manager, Request $request,SerializerInterface $serializerInterface)
    {
        // Get data with request
        $data = $request->getContent();

        // Decode content of request
        $decodeData = \json_decode($data);
        
        // Get User by email from request
        $user = $userRepository->findOneByEmail($decodeData->email);

        // Test if login is valid
        if($decodeData->password == $user->getPassword()) {
            return new JsonResponse("success", Response::HTTP_OK, [], true);
        } else {
            return new JsonResponse("failed", Response::HTTP_OK, [], true);
        }
    }
}
