<?php

namespace App\Repository;

use App\Entity\Advert;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Advert|null find($id, $lockMode = null, $lockVersion = null)
 * @method Advert|null findOneBy(array $criteria, array $orderBy = null)
 * @method Advert[]    findAll()
 * @method Advert[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdvertRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Advert::class);
    }

    // /**
    //  * @return Advert[] Returns an array of Advert objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Advert
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findByType($type)
    {
        return $this->createQueryBuilder('a')
            ->innerJoin('a.type', 'type')
            ->andWhere('type.name = :type')
            ->setParameter('type', $type)
            ->orderBy('a.createdAt', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function findBySearch(?string $search)
    {
        return $this->createQueryBuilder('a')
            ->innerJoin('a.type', 'type')
            ->innerJoin('a.brand', 'brand')
            ->orWhere('type.name LIKE :search')
            ->orWhere('a.name LIKE :search')
            ->orWhere('a.description LIKE :search')
            ->orWhere('brand.name LIKE :search')
            ->setParameter('search','%' . $search . '%')
            ->orderBy('a.createdAt', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }
}
