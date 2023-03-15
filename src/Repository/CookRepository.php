<?php

namespace App\Repository;

use App\Entity\Cook;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cook>
 *
 * @method Cook|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cook|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cook[]    findAll()
 * @method Cook[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cook::class);
    }

    public function add(Cook $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Cook $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Cook[] Returns an array of Cook objects
     */
    public function findTopByDishes(): array
    {
        return $this->createQueryBuilder('c')
            ->select('c.id', 'c.name')
//            ->addSelect('COUNT(c.id) AS ')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->leftJoin('dish', 'd', 'd.cookId = c.id')
//            ->orderBy('d.dish', 'ASC')
//            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

}
