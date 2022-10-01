<?php

namespace App\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Symfony\Component\Validator\Constraints\NotBlank;

#[Entity]
#[Table(name: 'todos')]
class ToDo
{
    #[Id]
    #[GeneratedValue(strategy: 'AUTO')]
    #[Column]
    private $id;

    #[Column]
    #[NotBlank]
    private $description;

    #[Column]
    private $isDone;

    /**
     * @param $name
     * @param $isDone
     */
    public function __construct($id, $description, $isDone)
    {
        $this->id = $id;
        $this->description= $description;
        $this->isDone = $isDone;
    }


    /**
     * @return mixed
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param mixed $name
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getIsDone(): bool
    {
        return $this->isDone;
    }

    /**
     * @param mixed $isDone
     */
    public function setIsDone(bool $isDone): void
    {
        $this->isDone = $isDone;
    }



}