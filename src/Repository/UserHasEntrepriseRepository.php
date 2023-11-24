<?php

namespace App\Repository;

use App\Entity\UserHasEntreprise;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserHasEntreprise>
 *
 * @method UserHasEntreprise|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserHasEntreprise|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserHasEntreprise[]    findAll()
 * @method UserHasEntreprise[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserHasEntrepriseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserHasEntreprise::class);
    }

//    /**
//     * @return UserHasEntreprise[] Returns an array of UserHasEntreprise objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?UserHasEntreprise
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
