<?php

namespace App\Controller;

use App\Entity\ToDo;
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
    public function home(Environment $twig, ManagerRegistry $doctrine):Response{

        $todos = $doctrine->getRepository(ToDo::class)->findAll();
        if(empty($todos)){
            throw $this->createNotFoundException('No to dos found');
        }

        $html = $twig->render('home.html.twig', [
            'todos' => $todos
        ]);
        return new Response($html);
    }
}