<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UIdRepository")
 */
class Uid
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $uid;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Link", mappedBy="uid")
     */
    private $link;

    public function __construct($id)
    {
        $this->uid = $id;

    }

    public function setLink($link)
    {
        $this->link = $link;
    }

    public function getUid()
    {
        return $this->uid;
    }
}
