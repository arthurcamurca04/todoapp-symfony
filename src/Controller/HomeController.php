<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class HomeController extends AbstractController{

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    #[Route('/', name:'home_page')]
    public function home(Environment $twig):Response{

        $todos = [
            [
                'id' => 1,
                'description' => 'Clean the House',
                'isDone' => false
            ],

            [
                'id' => 2,
                'description' => 'Study Programming',
                'isDone' => true
            ],

            [
                'id' => 3,
                'description' => 'Wash the Car',
                'isDone' => false
            ],
            [
                'id' => 4,
                'description' => 'Go shopping',
                'isDone' => true
            ]
        ];

        $html = $twig->render('home.html.twig', [
            'todos' => $todos
        ]);
        return new Response($html);
    }
}