<?php

namespace App\Repository;

use App\Entity\CollectionProduit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CollectionProduit|null find($id, $lockMode = null, $lockVersion = null)
 * @method CollectionProduit|null findOneBy(array $criteria, array $orderBy = null)
 * @method CollectionProduit[]    findAll()
 * @method CollectionProduit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CollectionProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CollectionProduit::class);
    }

    // /**
    //  * @return CollectionProduit[] Returns an array of CollectionProduit objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CollectionProduit
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
