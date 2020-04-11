<?php

namespace App\Repository;

use App\Entity\WakeonlanDevice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method WakeonlanDevice|null find($id, $lockMode = null, $lockVersion = null)
 * @method WakeonlanDevice|null findOneBy(array $criteria, array $orderBy = null)
 * @method WakeonlanDevice[]    findAll()
 * @method WakeonlanDevice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WakeonlanDeviceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WakeonlanDevice::class);
    }

    // /**
    //  * @return WakeonlanDevice[] Returns an array of WakeonlanDevice objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?WakeonlanDevice
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
