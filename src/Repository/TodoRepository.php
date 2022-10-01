<?php

namespace App\Repository;

use App\Entity\ToDo;
use Doctrine\ORM\Repository\RepositoryFactory;
use Doctrine\Persistence\ManagerRegistry;

class TodoRepository {

    private ManagerRegistry $doctrine;

    public function findAllToDos():array
    {
        $todos = $this->doctrine->getRepository(ToDo::class)->findAll();
        return $todos;
    }
}