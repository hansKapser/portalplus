<?php

namespace App\Repository;

use App\Entity\P17Firms;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method P17Firms|null find($id, $lockMode = null, $lockVersion = null)
 * @method P17Firms|null findOneBy(array $criteria, array $orderBy = null)
 * @method P17Firms[]    findAll()
 * @method P17Firms[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class P17FirmsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, P17Firms::class);
    }

//    /**
//     * @return P17Firms[] Returns an array of P17Firms objects
//     */
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
    public function findOneBySomeField($value): ?P17Firms
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
