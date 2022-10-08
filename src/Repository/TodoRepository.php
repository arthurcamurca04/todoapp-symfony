<?php

namespace App\Repository;

use App\Entity\ToDo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\Repository\RepositoryFactory;
use Doctrine\Persistence\ManagerRegistry;

class TodoRepository extends ServiceEntityRepository {

    /**
     * @param ManagerRegistry $doctrine
     */
    public function __construct(ManagerRegistry $doctrine)
    {
        parent::__construct($doctrine, ToDo::class);
    }

    /**
     * @param ToDo $todo
     * @param bool $flush
     */
    public function save(Todo $todo, bool $flush = false): void{
        $this->getEntityManager()->persist($todo);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @param ToDo $todo
     * @param bool $flush
     * @throws ORMException
     */
    public function update(Todo $todo, bool $flush = false): void{
        $data = $this->getEntityManager()->getReference(ToDo::class, $todo->getId());
        $data->setDescription($todo->getDescription());
        $data->setIsDone($todo->getIsDone());
        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @param ToDo $todo
     * @param bool $flush
     */
    public function remove(Todo $todo, bool $flush = false): void
    {
        $this->getEntityManager()->remove($todo);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    //    /**
//     * @return Product[] Returns an array of Product objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Product
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}