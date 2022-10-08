<?php

namespace App\Controller;

use App\Entity\ToDo;
use App\Repository\TodoRepository;
use Doctrine\ORM\Exception\ORMException;
use Psr\Log\LoggerInterface;
use Doctrine\Persistence\ManagerRegistry;
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
    public function addToDo(Request $request, TodoRepository $todoRepository):Response{

        $todo = new ToDo(1,'', false);

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

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();
            $newTodo = new ToDo($data->getId(),$data->getDescription(), $data->getIsDone());
            $todoRepository->save($newTodo, true);

            return $this->redirectToRoute('home_page');
        }
        
        return $this->renderForm('add-todo.html.twig', [
            'form' => $form
        ]);
    }

    /**
     * @Route("/todo/edit/{id}", name="todo_edit_page")
     * @throws ORMException
     */
    public function editToDo(Request $request, TodoRepository $todoRepository, string $id=null):Response {

        $foundedToDo = $todoRepository->findOneBy(['id'=>$id]);

        $form = $this->createFormBuilder($foundedToDo)
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

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();
            $newTodo = new ToDo($data->getId(),$data->getDescription(), $data->getIsDone());
            $todoRepository->update($newTodo, true);

            return $this->redirectToRoute('home_page');
        }

        return $this->renderForm('add-todo.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/todo/remove/{id}', name: 'todo_remove_page')]
    public function removeToDo(Request $request, TodoRepository $todoRepository, string $id=null): Response {
        $todo = $todoRepository->findOneBy(['id'=>$id]);
        $todoRepository->remove($todo, true);
        return $this->redirect('/', Response::HTTP_MOVED_PERMANENTLY);
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