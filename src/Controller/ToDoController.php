<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ToDoController extends AbstractController{

    #[Route('/todo/add', name:'todo_add_controller')]
    public function addToDo():Response{
        return $this->render('add-todo.html.twig', []);
    }

    /**
     * @Route("/todo/edit/{id}", name="todo_edit_controller")
     */
    public function editToDo(string $id=null):Response{
        return $this->render('edit-todo.html.twig', [
            'id' => $id
        ]);
    }
}