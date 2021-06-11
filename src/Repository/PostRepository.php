<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null binfindOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository
{
    /**
     * PostRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Post::class);
    }

    // /**
    //  * @return Post[] Returns an array of Post objects
    //  */
    public function findByAll()
    {
        return $this->findBy([], ['createdAt'=>'DESC']);
    }


     /**
     * @return Query
     */
    public function findBySearch($search) : array
    {
    $query =$this->createQueryBuilder('c')
            ->where("c.content LIKE :search")
            ->setParameter('search','%' . $search['tag']. '%')
            ->getQuery();
    try {
        return $query->getResult();
    }
    catch(\Exception $e) {
        throw new \Exception('problème '. $e->getMessage());
    }

    }


}
