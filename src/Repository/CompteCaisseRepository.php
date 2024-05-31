<?php

namespace App\Repository;

use App\Entity\CompteCaisse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CompteCaisse>
 *
 * @method CompteCaisse|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompteCaisse|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompteCaisse[]    findAll()
 * @method CompteCaisse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompteCaisseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompteCaisse::class);
    }

//    /**
//     * @return CompteCaisse[] Returns an array of CompteCaisse objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CompteCaisse
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
