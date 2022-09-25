<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController{

    #[Route('/', name:'home_page')]
    public function home():Response{

        $todos = [
            [
                'id' => 1,
                'name' => 'Clean the House',
                'isDone' => false
            ],

            [
                'id' => 2,
                'name' => 'Study Programming',
                'isDone' => true
            ],

            [
                'id' => 3,
                'name' => 'Wash the Car',
                'isDone' => false
            ],
            [
                'id' => 4,
                'name' => 'Go shopping',
                'isDone' => true
            ]
        ];
        return $this->render('home.html.twig', [
            'todos' => $todos
        ]);
    }
}