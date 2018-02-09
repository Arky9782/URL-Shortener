<?php

namespace App\Repository;

use Doctrine\ORM\EntityManagerInterface;


class UidRepository
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function findLink($id)
    {
        return $this->em->createQueryBuilder()
            ->select('l.link')
            ->from('App:Link', 'l')
            ->innerJoin('l.uid', 'u')
            ->where('u.uid = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
    }

    public function persist($uid)
    {
        $this->em->persist($uid);
    }

}
