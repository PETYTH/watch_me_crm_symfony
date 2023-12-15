<?php

namespace App\Repository;

use App\Entity\Entreprise;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Entreprise>
 *
 * @method Entreprise|null find($id, $lockMode = null, $lockVersion = null)
 * @method Entreprise|null findOneBy(array $criteria, array $orderBy = null)
 * @method Entreprise[]    findAll()
 * @method Entreprise[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EntrepriseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Entreprise::class);
    }

    /**
     * Retourne les clients associés à une entreprise spécifique.
     *
     * @param int $entrepriseId L'ID de l'entreprise pour laquelle rechercher les clients
     * @return Entreprise|null L'entité Entreprise correspondante
     */
    public function findClientsByEntreprise(int $entrepriseId): ?Entreprise
    {
        return $this->createQueryBuilder('e')
            ->leftJoin('e.clients', 'c')
            ->addSelect('c')
            ->where('e.id = :id')
            ->setParameter('id', $entrepriseId)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function countClientsByStatus(int $entrepriseId): array
    {
        return $this->createQueryBuilder('e')
            ->select('c.status, COUNT(c.id) as count')
            ->join('e.clients', 'c')
            ->andWhere('e.id = :entrepriseId')
            ->groupBy('c.status')
            ->setParameter('entrepriseId', $entrepriseId)
            ->getQuery()
            ->getResult();
    }

//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Entreprise
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
