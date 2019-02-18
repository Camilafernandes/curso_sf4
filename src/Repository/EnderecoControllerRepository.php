<?php

namespace App\Repository;

use App\Entity\EnderecoController;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method EnderecoController|null find($id, $lockMode = null, $lockVersion = null)
 * @method EnderecoController|null findOneBy(array $criteria, array $orderBy = null)
 * @method EnderecoController[]    findAll()
 * @method EnderecoController[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EnderecoControllerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, EnderecoController::class);
    }

    // /**
    //  * @return EnderecoController[] Returns an array of EnderecoController objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EnderecoController
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
