<?php

namespace App\Repository;

use Doctrine\ORM\EntityManagerInterface;

class LinkRepository
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    public function persist($link)
    {
        $this->em->persist($link);
    }
}
