<?php

namespace App\Repository;

use App\Entity\Produtos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Produtos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produtos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produtos[]    findAll()
 * @method Produtos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProdutosRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Produtos::class);
    }

    // /**
    //  * @return Produtos[] Returns an array of Produtos objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Produtos
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
