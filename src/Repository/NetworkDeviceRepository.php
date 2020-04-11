<?php

namespace App\Repository;

use App\Entity\NetworkDevice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method NetworkDevice|null find($id, $lockMode = null, $lockVersion = null)
 * @method NetworkDevice|null findOneBy(array $criteria, array $orderBy = null)
 * @method NetworkDevice[]    findAll()
 * @method NetworkDevice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NetworkDeviceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NetworkDevice::class);
    }

    // /**
    //  * @return NetworkDevice[] Returns an array of NetworkDevice objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NetworkDevice
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
