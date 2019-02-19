<?php

namespace App\Repository;

use App\Entity\Tecnologias;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Tecnologias|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tecnologias|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tecnologias[]    findAll()
 * @method Tecnologias[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TecnologiasRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Tecnologias::class);
    }

    // /**
    //  * @return Tecnologias[] Returns an array of Tecnologias objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Tecnologias
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
