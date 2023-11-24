<?php

namespace App\Repository;

use App\Entity\ClientHasEntreprise;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ClientHasEntreprise>
 *
 * @method ClientHasEntreprise|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClientHasEntreprise|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClientHasEntreprise[]    findAll()
 * @method ClientHasEntreprise[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientHasEntrepriseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClientHasEntreprise::class);
    }

//    /**
//     * @return ClientHasEntreprise[] Returns an array of ClientHasEntreprise objects
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

//    public function findOneBySomeField($value): ?ClientHasEntreprise
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
