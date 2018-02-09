<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 09.02.2018
 * Time: 16:05
 */

namespace App\Service;


use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\Tests\Compiler\E;

final class Flush
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function __invoke()
    {
        $this->em->flush();
    }

}