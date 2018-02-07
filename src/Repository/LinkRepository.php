<?php

namespace App\Repository;

use App\Entity\Link;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class LinkRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Link::class);
    }

    public function findLink($id)
    {
        return $this->createQueryBuilder()
            ->select('l.link')
            ->from('App:Link', 'l')
            ->innerJoin('l.uid', 'u')
            ->where('u.uid = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
    }
}
