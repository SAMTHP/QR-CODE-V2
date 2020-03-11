<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
     * Allow to redirect to administration view
     * 
     * @IsGranted("ROLE_ADMIN")
     * @Route("/", name="admin_index")
     * @author Samir Founou
     * 
     * @return Response
     */
    public function index()
    {
        return $this->render('admin/index.html.twig');
    }
}