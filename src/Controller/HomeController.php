<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController{

    #[Route('/', name:'home_controller')]
    public function home():Response{

        $name = 'Rakel';
        return $this->render('home.html.twig', [
            'name' => $name
        ]);
    }
}