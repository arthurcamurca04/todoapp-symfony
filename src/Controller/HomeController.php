<?php

namespace App\Controller;

use App\Entity\ToDo;
use App\Repository\TodoRepository;
use Doctrine\Persistence\ManagerRegistry;
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
    public function home(Environment $twig, TodoRepository $todoRepository):Response{

        //$todos = $doctrine->getRepository(ToDo::class)->findAll();
        $todos = $todoRepository->findAll();
        if(empty($todos)){
            $todos = [];
        }

        $html = $twig->render('home.html.twig', [
            'todos' => $todos
        ]);
        return new Response($html);
    }
}