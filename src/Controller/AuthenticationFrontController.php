<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AuthenticationFrontController extends AbstractController
{
    /**
     * Allow to login
     * 
     * @Route("/authentication", name="authentication_login", methods={"POST"})
     * 
     * @param UserRepository $userRepository
     * @param Request $request
     * @param UserPasswordEncoderInterface $userPasswordEncoderInterface
     * @param SerializerInterface $serializerInterface
     * @return JsonResponse
     * @author Samir Founou
     */
    public function authentication(UserRepository $userRepository, Request $request,UserPasswordEncoderInterface $userPasswordEncoderInterface, SerializerInterface $serializerInterface)
    {
        // Get data with request
        $data = $request->getContent();

        // Decode content of request
        $decodeData = \json_decode($data);
        
        // Get User by email from request
        $user = $userRepository->findOneByEmail($decodeData->username);

        // Test if login is valid
        if($user){
             // hasValid equal true if password valid or false if is not
            $hashValid = $userPasswordEncoderInterface->isPasswordValid($user, $decodeData->password);
            if($hashValid) {

                $result = $serializerInterface->serialize(
                    $user->setPassword(false),
                    'json'
                );

                return new JsonResponse(
                    '{
                        "user": '.$result.'
                    }',
                    Response::HTTP_OK,
                    [],
                    true
                );
            } else {
                return new JsonResponse('{"authentication" : "failed"}', Response::HTTP_OK, [], true);
            }
        } else {
            return new JsonResponse('{"authentication" : "failed"}', Response::HTTP_OK, [], true);
        }
    }

    /**
     * Allow to get an user by his email
     *
     * @Route("/api/users/find_by_email", name="authentication_find_by_email", methods={"POST"})
     * 
     * @param SerializerInterface $serializerInterface
     * @param UserRepository $userRepository
     * @param Request $request
     * @author Samir Founou
     * @return JsonResponse
     */
    public function getUserByEmail(SerializerInterface $serializerInterface,UserRepository $userRepository, Request $request)
    {
        $data = $request->getContent();
        $decodeData = \json_decode($data);

        $user = $userRepository->findOneByEmail($decodeData->username);

        $result = $serializerInterface->serialize(
            $user,
            'json'
        );

        return new JsonResponse(
            $result,
            Response::HTTP_OK,
            [],
            true
        );
    }
}
