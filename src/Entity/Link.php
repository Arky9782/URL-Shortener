<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\NotBlank()
     * @Assert\Url(
     *     protocols = {"http", "https"}
     * )
     * @ORM\Column(type="string", length=255)
     */
    private $link;

    /**
     * @ORM\OneToOne(targetEntity="Uid", inversedBy="link")
     */
    private $uid;


    public function Uid($id)
    {
        $this->uid = $id;
    }

    public function getLink()
    {
        return $this->link;
    }

    public function setLink($link)
    {
        return $this->link = $link;
    }




}
