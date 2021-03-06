<?php
namespace VL\SiteBundle\Repository;
use Doctrine\ORM\EntityRepository;
/**
 * ArtRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ArtRepository extends \Doctrine\ORM\EntityRepository
{
    public function getActiveArts($categoryId = null, $max = null, $offset = null)
    {
        $qb = $this->createQueryBuilder('a')
            ->Where('a.is_public = :public')
            ->setParameter('public', 1)
            ->orderBy('a.created_at', 'DESC');
        if($max) {
            $qb->setMaxResults($max);
        }

        if($offset) {
            $qb->setFirstResult($offset);
        }

        if($categoryId) {
            $qb->andWhere('a.category = :category_id')
                ->setParameter('category_id', $categoryId);
        }

        $query = $qb->getQuery();

        return $query->getResult();
    }



    public function countActiveArts($categoryId = null)
    {
        $qb = $this->createQueryBuilder('a')
            ->select('count(a.id)')
            ->Where('a.is_public = :public')
            ->setParameter('public', 1);

        if($categoryId)
        {
            $qb->andWhere('a.category = :category_id')
                ->setParameter('category_id', $categoryId);
        }

        $query = $qb->getQuery();

        return $query->getSingleScalarResult();
    }


    public function getActiveArt($slug)
    {
        $query = $this->createQueryBuilder('a')
            ->where('a.id = :id')
            ->setParameter('id', $slug)
            ->andWhere('a.is_public = :public')
            ->setParameter('public', 1)
            ->setMaxResults(1)
            ->getQuery();


        try {
            $art = $query->getSingleResult();
        } catch (\Doctrine\Orm\NoResultException $e) {
            $art = null;
        }

        return $art;
    }


    public function getActiveArtgl()
    {
        $query = $this->createQueryBuilder('a')
            ->Where('a.type = :type')
            ->setParameter('type', 'Главная')
            ->setMaxResults(1)
            ->getQuery();

        try {
            $art = $query->getSingleResult();
        } catch (\Doctrine\Orm\NoResultException $e) {
            $art = null;
        }

        return $art;
    }

}
