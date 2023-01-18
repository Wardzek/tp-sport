<?php

namespace App\Repository;

use App\Entity\Team;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Team>
 *
 * @method Team|null find($id, $lockMode = null, $lockVersion = null)
 * @method Team|null findOneBy(array $criteria, array $orderBy = null)
 * @method Team[]    findAll()
 * @method Team[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TeamRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Team::class);
    }

    public function add(Team $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Team $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Team[] Returns an array of Team objects
//     */
    public function findThreeLastTeam(): array
    {
        return $this->createQueryBuilder('t')
            ->orderBy('t.id', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult()
       ;
    }

    public function findThreeTeamMostPeople(): array
    {
        return $this->createQueryBuilder('t')
            ->addSelect('count(a.id) as hidden nbAthlete')
            ->join('t.athetes', 'a')
            ->groupBy('t.id')
            ->orderBy('nbAthlete', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult()
            ;
    }

    public function searchTeam($value): array
   {
       return $this->createQueryBuilder('t')
           ->where('t.name like :val')
           ->setParameter('val', "%".$value."%")
           ->getQuery()
           ->getResult()
       ;
  }
}
