<?php

namespace App\Repository;

use App\Entity\Candidate;
use App\Entity\CandidateJobOffer;
use App\Entity\JobOffer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CandidateJobOffer>
 *
 * @method CandidateJobOffer|null find($id, $lockMode = null, $lockVersion = null)
 * @method CandidateJobOffer|null findOneBy(array $criteria, array $orderBy = null)
 * @method CandidateJobOffer[]    findAll()
 * @method CandidateJobOffer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CandidateJobOfferRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CandidateJobOffer::class);
    }

    public function add(CandidateJobOffer $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CandidateJobOffer $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CandidateJobOffer[] Returns an array of CandidateJobOffer objects
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

//    public function findOneBySomeField($value): ?CandidateJobOffer
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

      public function findOneByCandidateId(Candidate $candidate, JobOffer $jobOffer)
      {
        return $this->getEntityManager()->createQuery("
          SELECT cj, c, jo FROM App\Entity\CandidateJobOffer cj
          JOIN cj.candidate_id c
          JOIN cj.jobOffers_id jo
          WHERE c.id = :candidateId
          AND jo.id = :jobOfferId
        ")
          ->setParameter('candidateId', $candidate)
          ->setParameter('jobOfferId', $jobOffer)
          ->getResult();
      }

      public function findAllApply()
      {
        return $this->getEntityManager()->createQuery("
              SELECT cj, c, jo FROM App\Entity\CandidateJobOffer cj
              JOIN cj.candidate_id c
              JOIN cj.jobOffers_id jo
            ")
          ->getResult();
      }
}
