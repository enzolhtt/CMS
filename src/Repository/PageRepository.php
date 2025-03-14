<?php

namespace App\Repository;

use App\Entity\Page;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Page>
 */
class PageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Page::class);
    }


    public function findPageBySeoUrl($seourl){
        return $this->createQueryBuilder('p')
            ->andWhere('p.seo_url = :seourl')
            ->setParameter('seourl', $seourl)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function findArticlesBySeoUrl($seourl)
{
    return $this->createQueryBuilder('p')
        ->andWhere('p.seo_url = :seourl')
        ->setParameter('seourl', $seourl)
        ->getQuery()
        ->getResult();
}

    //    /**
    //     * @return Page[] Returns an array of Page objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Page
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
