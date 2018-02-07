<?php

namespace App\Repository;

use App\Entity\Uid;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class UIdRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Uid::class);
    }

    public function findLink($id)
    {
        return $this->getEntityManager()->createQueryBuilder()
            ->select('l.link')
            ->from('App:Link', 'l')
            ->innerJoin('l.uid', 'u')
            ->where('u.uid = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
    }
}
