<?php

namespace App\Repository;

use App\Entity\CompteCredit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CompteCredit>
 *
 * @method CompteCredit|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompteCredit|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompteCredit[]    findAll()
 * @method CompteCredit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompteCreditRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompteCredit::class);
    }

//    /**
//     * @return CompteCredit[] Returns an array of CompteCredit objects
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

//    public function findOneBySomeField($value): ?CompteCredit
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
