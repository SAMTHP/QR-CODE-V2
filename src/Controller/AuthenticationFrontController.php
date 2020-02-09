<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
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
     * @return JsonResponse
     * @author Samir Founou
     */
    public function authentication(UserRepository $userRepository, Request $request,UserPasswordEncoderInterface $userPasswordEncoderInterface)
    {
        // Get data with request
        $data = $request->getContent();

        // Decode content of request
        $decodeData = \json_decode($data);
        
        // Get User by email from request
        $user = $userRepository->findOneByEmail($decodeData->email);

        // hasValid equal true if password valid or false if is not
        $hashValid = $userPasswordEncoderInterface->isPasswordValid($user, $decodeData->password);

        // Test if login is valid
        if($user){
            if($hashValid) {
                return new JsonResponse("success", Response::HTTP_OK, [], true);
            } else {
                return new JsonResponse("failed", Response::HTTP_OK, [], true);
            }
        } else {
            return new JsonResponse("failede", Response::HTTP_OK, [], true);
        }
    }

    /**
     * Allow to create an user account
     * 
     * @Route("/api/users", name="authentication_register", methods={"POST"})
     * 
     * @param EntityManagerInterface $manager
     * @param Request $request
     * @param  UserPasswordEncoderInterface $UserPasswordEncoderInterface
     * @return JsonResponse
     * @author Samir Founou
     */
    public function register(EntityManagerInterface $manager, Request $request,UserPasswordEncoderInterface $userPasswordEncoderInterface)
    {
        // Get data with request
        $data = $request->getContent();

        // Decode content of request
        $decodeData = \json_decode($data);

        $user = new User();
        
        $hash = $userPasswordEncoderInterface->encodePassword($user, $decodeData->password);

        $user->setFirstName($decodeData->firstName)
             ->setLastName($decodeData->lastName)
             ->setEmail($decodeData->email)
             ->setPassword($hash)
             ->setPhone($decodeData->phone)
             ->setHasAgreed($decodeData->hasAgreed);

        $manager->persist($user);
        $manager->flush();

        return new JsonResponse("Account created", Response::HTTP_OK, [], true);
    }


}
