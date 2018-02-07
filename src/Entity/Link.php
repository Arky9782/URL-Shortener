<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LinkRepository")
 */
class Link
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $link;

    /**
     * @ORM\OneToOne(targetEntity="Uid", inversedBy="link")
     */
    private $uid;

    public function __construct($link)
    {
        $this->link = $link;

    }

    public function setUid($id)
    {
        $this->uid = $id;
    }

    public function getLink()
    {
        return $this->link;
    }




}
