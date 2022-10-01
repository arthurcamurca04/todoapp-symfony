<?php

namespace App\Controller;

use App\Entity\ToDo;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ToDoController extends AbstractController{

    #[Route('/todo/add', name:'todo_add_page', methods: ['GET', 'POST'])]
    public function addToDo(Request $request):Response{

        $todo = new ToDo(1,'Write a blog post', false);

        $form = $this->createFormBuilder($todo)
            ->add('description', TextType::class, ['label' => 'Description: '])
            ->add('isDone', ChoiceType::class, [
                'choices' => [
                    'Yes' => true,
                    'No' => false
                ],
                'label' => 'Is it done? '
            ])
            ->add('save', SubmitType::class, ['label'=>'Add'])
            ->getForm();
        dd($request->request);
        return $this->renderForm('add-todo.html.twig', [
            'form' => $form
        ]);
    }

    /**
     * @Route("/todo/edit/{id}", name="todo_edit_page")
     */
    public function editToDo(string $id=null):Response{
        return $this->render('edit-todo.html.twig', [
            'id' => $id
        ]);
    }

    #[Route('/api/todo/{id<\d+>}', methods:['GET'])]
    public function getToDo(int $id, LoggerInterface $logger): Response {
        $todo = [
            'id' => $id,
            'name' => 'Wash my car',
            'isDone' => false
        ];

        $logger->info('Returning an API response for a To Do {todo}', [
            'todo'=> $id
        ]);
        return $this->json($todo);
    }

}