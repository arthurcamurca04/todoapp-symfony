<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
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
    private int $id;

    #[Column(type: Types::TEXT, length: 100, nullable: false)]
    #[NotBlank]
    private string $description;

    #[Column(type: Types::BOOLEAN, nullable: false)]
    private bool $isDone;

    /**
     * @param $id
     * @param $description
     * @param $isDone
     */
    public function __construct($id, $description, $isDone)
    {
        $this->id = $id;
        $this->description= $description;
        $this->isDone = $isDone;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return bool
     */
    public function getIsDone(): bool
    {
        return $this->isDone;
    }

    /**
     * @param bool $isDone
     */
    public function setIsDone(bool $isDone): void
    {
        $this->isDone = $isDone;
    }



}